<?php
# 预下单接口(用户主扫)
require_once 'config.php';
require_once 'bootstrap.php';

date_default_timezone_set("Asia/Shanghai");

use Asrx\Sandpay\PreCreate;
use Asrx\Sandpay\SimpleType;

$request = new PreCreate\PreCreateRequest();

$request->Head->ProductId = SimpleType\ProductId::_SAND_PRODUCT_ID_00000012;
$request->Head->AccessType = SimpleType\AccessType::_MERCHANT_ORDINARY;
$request->Head->Mid = SAND_MID;
$request->Head->ChannelType = SimpleType\ChannelType::_INTERNET_TERMINAL;

$request->Body->PayTool = SimpleType\PayTool::_UNIONPAY_SCAN_QRCODE;
$orderNo = 'TEST'.time().mt_rand(100,999);
$request->Body->OrderCode = $orderNo;
//$request->Body->LimitPay = 1; #支付工具为微信扫码有效；1-限定不能使用信用卡
$request->Body->TotalAmount = 0.01;// 测试1分钱
$request->Body->Subject = 'Test Pay:'.$orderNo;
$request->Body->Body = 'Test Pay:'.$orderNo;
$request->Body->TxnTimeOut = date('YmdHis',time());
$request->Body->NotifyUrl = 'http://www.XXX.com/notify';
$request->Body->Extend = '';

$req = new PreCreate\Request(SAND_CERT_PATH,SAND_PFX_PATH,SAND_PFX_PASSWORD);

$res = $req->handle($request);

var_dump($res);

