<?php

namespace Asrx\Sandpay\ComplexType;

use Asrx\Sandpay\AbstractComplexType;

/**
 * Class Request
 *
 * @package \Asrx\Sandpay\PreCreate
 *
 * @property Head $Head
 * @property IBody $Body
 *
 */
abstract class Request extends AbstractComplexType
{
    protected $name = 'Request';

    public function setHead(Head $requestHeader)
    {
        $this->values['head'] = $requestHeader;
        return $this;
    }
}
