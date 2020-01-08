<?php

namespace Asrx\Sandpay\PreCreate;

use Asrx\Sandpay\ComplexType\Head;
use Asrx\Sandpay\ComplexType\Request;

/**
 * Class PreCreateRequest
 *
 * @package \Asrx\Sandpay\PreCreate
 *
 * @property Head $Head
 * @property Body $Body
 *
 */
class PreCreateRequest extends Request
{
    protected $name = 'PreCreateRequest';

    /**
     * PreCreateRequest constructor.
     */
    public function __construct()
    {
        $this->Head->Method = 'sandpay.trade.precreate';
    }

    function setBody(Body $body)
    {
        $this->values['body'] = $body;
        return $this;
    }
}
