<?php
namespace Asrx\Sandpay;

use Curl\Curl;
use GuzzleHttp\Client;

/**
 * Abstract class for Request classes
 * @package Asrx\Sandpay
 */
abstract class AbstractRequest
{
    /**
     * URL to production environment
     */
    const PRODUCTION_URL = null;

    /**
     * URL to testing environment
     */
    const TESTING_URL = null;

    private $curl = null;

    private $response;

    /**
     * AbstractRequest constructor.
     * @throws \ErrorException
     */
    public function __construct()
    {
        $this->curl = new Curl();
    }

    /**
     * @return null
     */
    public final function getResponse()
    {
        return $this->curl->response;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public final function httpGet(string $uri)
    {
        $this->response = $this->curl->get($uri);
        return $this;
    }

    /**
     * @param string $uri
     * @param array $params
     * @return $this
     */
    public final function httpPost(string $uri,array $params)
    {
        $this->response = $this->curl->post($uri,$params);
        return $this;
    }

}
