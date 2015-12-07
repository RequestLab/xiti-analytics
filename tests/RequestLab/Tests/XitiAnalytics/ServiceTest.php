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

use RequestLab\XitiAnalytics\Service;

/**
 * Xiti analytics service test.
 *
 * @author ylcdx <yann@requestlab.fr>
 */
class ServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \RequestLab\XitiAnalytics\Service
     */
    protected $service;

    /**
     * @var \RequestLab\XitiAnalytics\Client
     */
    protected $clientMock;

    /**
     * @var \Widop\HttpAdapterBundle\Model\HttpAdapterInterface
     */
    protected $httpAdapterMock;

    /**
     * @var \RequestLab\XitiAnalytics\Query
     */
    protected $queryMock;

    /**
     * @var string
     */
    protected $login = 'login';

    /**
     * @var string
     */
    protected $password = 'password';

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->httpAdapterMock = $this->getMock('Widop\HttpAdapter\HttpAdapterInterface');
        $this->clientMock = $this->getMockBuilder('RequestLab\XitiAnalytics\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $this->clientMock
            ->expects($this->any())
            ->method('getLogin')
            ->will($this->returnValue($this->login));
        $this->clientMock
            ->expects($this->any())
            ->method('getPassword')
            ->will($this->returnValue($this->password));
        $this->clientMock
            ->expects($this->any())
            ->method('getHttpAdapter')
            ->will($this->returnValue($this->httpAdapterMock));
        $this->service = new Service($this->clientMock);
        $this->queryMock = $this->getMockBuilder('RequestLab\XitiAnalytics\Query')
            ->disableOriginalConstructor()
            ->getMock();
    }
    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->service);
        unset($this->clientMock);
        unset($this->queryMock);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->clientMock, $this->service->getClient());
    }

    public function testQuery()
    {
        $this->clientMock
            ->expects($this->once())
            ->method('getHeaders')
            ->will($this->returnValue(
                array(
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($this->login . ':' . $this->password)
                )
            ));

        $this->queryMock
            ->expects($this->once())
            ->method('build')
            ->will($this->returnValue('uri'));

        $expected = array(
            'DataFeed' => array(
                array(
                    'Columns' => array(
                        array(
                            'Name' => 'm_visits',
                            'Label' => 'Visites',
                            'Category' => 'Metric',
                            'Type' => 'Integer',
                            'CustomerType' => 'CustomerType',
                            'Summable' => false,
                            'Pie' => false,
                        ),
                        array(
                            "Name" => "m_page_loads",
                            "Label" => "Chargements",
                            "Category" => "Metric",
                            "Type" => "Integer",
                            "CustomerType" => "Integer",
                            "Summable" => true,
                            "Pie" => true
                        )
                    ),
                    'Rows' => array(
                        array(
                            "m_visits" => 68779,
                            "m_page_loads" => 466889
                        )
                    ),
                    'Totals' => array(
                        array(
                            "type" => "displayed",
                            "m_visits" => "-",
                            "m_page_loads" => 466889
                        )
                    )
                )
            )
        );

        $this->httpAdapterMock
            ->expects($this->once())
            ->method('getContent')
            ->with($this->equalTo('uri'))
            ->will($this->returnValue(json_encode($expected)));

        $response = $this->service->query($this->queryMock);
        //var_dump($this->queryMock); die();
        //var_dump($response); die();
        $this->assertSame($expected['DataFeed'][0]['Columns'], $response->getColumns());
        $this->assertTrue($response->hasRows());
        $this->assertSame($expected['DataFeed'][0]['Rows'], $response->getRows());
        $this->assertSame($expected['DataFeed'][0]['Totals'], $response->getTotals());

    }

    /**
     * @expectedException \RequestLab\XitiAnalytics\XitiException
     */
    public function testQueryWithJsonError()
    {
        $this->clientMock
            ->expects($this->once())
            ->method('getHeaders')
            ->will($this->returnValue(
                array(
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($this->login . ':' . $this->password)
                )
            ));

        $this->queryMock
            ->expects($this->once())
            ->method('build')
            ->will($this->returnValue('uri'));

        $this->httpAdapterMock
            ->expects($this->once())
            ->method('getContent')
            ->with($this->equalTo('uri'))
            ->will($this->returnValue(json_encode(array('ErrorCode' => '2017', 'ErrorMessage' => 'Le message'))));
        $this->service->query($this->queryMock);
    }

}