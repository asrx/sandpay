<?php

namespace Asrx\Sandpay\ComplexType;

use Asrx\Sandpay\AbstractComplexType;

/**
 * Class Head
 *
 * @package \Asrx\Sandpay\ComplexType
 *
 * @property string $Version
 * @property string $RespTime
 * @property string $RespCode
 * @property string $RespMsg
 */
class ResponseHeader extends AbstractComplexType
{
    protected $name = 'head';

    /**
     * Head constructor.
     */
    public function __construct()
    {
        $this->Version = '1.0';
    }

    /**
     * 版本号
     * @param $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->values['version'] = $version;
        return $this;
    }

    /**
     * 响应时间
     * @param $respTime
     * @return $this
     */
    public function setRespTime($respTime)
    {
        $this->values['respTime'] = $respTime;
        return $this;
    }

    /**
     * 响应码
     * @param $respCode
     * @return $this
     */
    public function setRespCode($respCode)
    {
        $this->values['respCode'] = $respCode;
        return $this;
    }

    /**
     * 响应描述
     * @param $respMsg
     * @return $this
     */
    public function setRespMsg($respMsg)
    {
        $this->values['respMsg'] = $respMsg;
        return $this;
    }
}
