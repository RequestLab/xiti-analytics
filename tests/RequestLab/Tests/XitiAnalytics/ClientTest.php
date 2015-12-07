<?php

/*
 * This file is part of the RequestLab package.
 *
 * (c) RequestLab <hello@requestlab.fr>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace RequestLab\Tests\XitiAnalytics;

use RequestLab\XitiAnalytics\Client;

/**
 * Xiti analytics client test.
 *
 * @author ylcdx <yann@requestlab.fr>
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \RequestLab\XitiAnalytics\Client
     */
    protected $client;

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
    protected $httpAdapterMock;

    /**
     * @var array
     */
    protected $headers;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->login            = 'test';
        $this->password         = 'testPassword';
        $this->httpAdapterMock  = $this->getMock('Widop\HttpAdapter\HttpAdapterInterface');
        $this->headers          = array(
            'Content-Type'  => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->login . ':' . $this->password)
        );
        $this->client           = new Client($this->login, $this->password, $this->httpAdapterMock);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->client);
        unset($this->login);
        unset($this->password);
        unset($this->httpAdapterMock);
    }

    public function testGetHeaders() {
        $this->assertSame($this->headers, $this->client->getHeaders());
    }
}