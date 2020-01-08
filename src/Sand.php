<?php

namespace Asrx\Sandpay;

/**
 * Class Sand
 *
 * @package \Asrx\Sandpay
 */
class Sand extends AbstractRequest
{
    private $certPath;
    private $pfxPath;
    private $password;

    private $data;
    private $signContent;

    /**
     * @param null $certPath
     */
    public function setCertPath($certPath)
    {
        $this->certPath = $certPath;
    }

    /**
     * @param null $pfxPath
     */
    public function setPfxPath($pfxPath)
    {
        $this->pfxPath = $pfxPath;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Sand constructor.
     * @param null $certPath
     * @param null $pfxPath
     * @param null $password
     * @throws \ErrorException
     */
    public function __construct($certPath = null, $pfxPath = null, $password = null)
    {
        parent::__construct();
        $this->certPath = $certPath;
        $this->pfxPath = $pfxPath;
        $this->password = $password;
    }

    /**
     * 获取公钥
     * @return mixed
     * @throws \Exception
     */
    private function loadX509Cert()
    {
        try {
            $file = file_get_contents($this->certPath);
            if (!$file){
                throw new \Exception('`SandPay cert` File Is Not Found.');
            }

            $cert = chunk_split(base64_encode($file));
            $cert = "-----BEGIN CERTIFICATE-----\n{$cert}-----END CERTIFICATE-----\n";

            $res = openssl_pkey_get_public($cert);
            $content = openssl_pkey_get_details($res);
            openssl_free_key($res);

            if (!$content){
                throw new \Exception('`SandPay cert` Is Error');
            }
            return $content['key'];
        }catch (\Exception $e){
            throw $e;
        }
    }

    /**
     * 获取私钥
     * @return mixed
     * @throws \Exception
     */
    private function loadPk12Cert()
    {
        try {
            $file = file_get_contents($this->pfxPath);
            if (!$file) {
                throw new \Exception('`SandPay pfx` File Is Not Found.');
            }

            if (!openssl_pkcs12_read($file, $content, $this->password)) {
                throw new \Exception('`SandPay pfx` Is Error');
            }
            return $content['pkey'];
        } catch (\Exception $e) {
            throw $e;
        }
    }


    /**
     * 私钥签名
     * @param $plainText
     * @return $this
     * @throws \Exception
     */
    public final function sign($plainText)
    {
        $this->data = $plainText;
        $path = $this->loadPk12Cert();

        $plainText = json_encode($plainText);
        try {
            $resource = openssl_pkey_get_private($path);
            $result = openssl_sign($plainText, $sign, $resource);
            openssl_free_key($resource);

            if (!$result) {
                throw new \Exception('Sign Error: ' . $plainText);
            }

            $this->signContent = base64_encode($sign);
        } catch (\Exception $e) {
            throw $e;
        }
        return $this;
    }

    /**
     * 验证签名
     * @param $plainText
     * @param $signContent
     * @return bool
     * @throws \Exception
     */
    public final function verify($plainText, $signContent)
    {
        $path = $this->loadX509Cert();

        $resource = openssl_pkey_get_public($path);
        $result = openssl_verify($plainText, base64_decode($signContent), $resource);
        openssl_free_key($resource);

        return $result ? true : false;
//        if (!$result){
//            throw new \Exception('Signature verification failed.');
//        }
//        return true;
    }

    public final function parseResult($result)
    {
        $arr = [];
        $response = urldecode($result);
        $arrStr = explode('&',$response);
        foreach ($arrStr as $item) {
            $p = strpos($item,'=');
            $key = substr($item,0,$p);
            $value = substr($item,$p+1);
            $arr[$key] = $value;
        }

        return $arr;
    }

    public final function getRequestParams()
    {
        if ($this->signContent){
            return [
                'charset' => 'utf-8',
                'shignType' => '01',
                'data' => json_encode($this->data),
                'sign' => $this->signContent
            ];
        }
        throw new \Exception('Need to Signed.');
    }

}
