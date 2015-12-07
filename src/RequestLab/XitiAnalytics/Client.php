<?php

/*
 * This file is part of the RequestLab package.
 *
 * (c) RequestLab <hello@requestlab.fr>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace RequestLab\XitiAnalytics;

use Widop\HttpAdapter\HttpAdapterInterface;

/**
 * Xiti analytics client.
 *
 * @author ylcdx <yann@requestlab.fr>
 */
class Client
{
    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var \Widop\HttpAdapterBundle\Model\HttpAdapterInterface
     */
    protected $httpAdapter;

    /**
     * Client constructor.
     *
     * @param $login
     * @param $password
     * @param HttpAdapterInterface $httpAdapter
     */
    public function __construct($login, $password, HttpAdapterInterface $httpAdapter)
    {
        $this->login        = $login;
        $this->password     = $password;
        $this->httpAdapter  = $httpAdapter;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return \Widop\HttpAdapterBundle\Model\HttpAdapterInterface
     */
    public function getHttpAdapter()
    {
        return $this->httpAdapter;
    }

    /**
     * @param \Widop\HttpAdapterBundle\Model\HttpAdapterInterface $httpAdapter
     */
    public function setHttpAdapter($httpAdapter)
    {
        $this->httpAdapter = $httpAdapter;
    }

    /**
     * @return array
     */
    public function getHeaders($clientRequestId = null)
    {

        $headers = array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->getLogin() . ':' . $this->getPassword())
        );

        if ($clientRequestId) {
            $headers['ClientRequestID'] = $clientRequestId;
        }

        return $headers;
    }


}