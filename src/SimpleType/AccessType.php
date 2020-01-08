<?php

namespace Asrx\Sandpay\SimpleType;

use Asrx\Sandpay\AbstractSimpleType;

/**
 * Class PayTool
 *
 * @package \Asrx\Sandpay\SimpleType
 */
class AccessType extends AbstractSimpleType
{
    // 1-普通商户接入
    const _MERCHANT_ORDINARY = '1';

    // 2-平台商户接入
    const _MERCHANT_PLATFORM = '2';

    // 3-核心企业商户接入
    const _MERCHANT_CORE_ENTERPRISE = '3';
}
