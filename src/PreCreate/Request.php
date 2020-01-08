<?php

namespace Asrx\Sandpay\PreCreate;

use Asrx\Sandpay\Sand;

/**
 * Class Request
 *
 * @package \Asrx\Sandpay\PreCreate
 */
class Request extends Sand
{
    const PRODUCTION_URL = 'https://cashier.sandpay.com.cn/qr/api/order/create';

    /**
     * Request constructor.
     */
    public function __construct($certPath = null, $pfxPath = null, $password = null)
    {
        parent::__construct($certPath,$pfxPath,$password);
    }

    public function handle(PreCreateRequest $request)
    {
        $data = $request->toArray();

        $post = $this->sign($data)->getRequestParams();

        $this->httpPost(self::PRODUCTION_URL,$post);

        $result = $this->parseResult($this->getResponse());

        if (!$this->verify($result['data'],$result['sign'])){
            throw new \Exception('Signature verification failed.');
        }

        return $result;
    }

}
