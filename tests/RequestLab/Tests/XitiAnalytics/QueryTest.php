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

use RequestLab\XitiAnalytics\Query;

/**
 * Xiti analytics query test.
 *
 * @author ylcdx <yann@requestlab.fr>
 */
class QueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \RequestLab\XitiAnalytics\Query
     */
    protected $query;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->query = new Query();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->query);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->query->hasL2());
        $this->assertFalse($this->query->hasStartDate());
        $this->assertFalse($this->query->hasEndDate());
        $this->assertFalse($this->query->hasFilter());
        $this->assertFalse($this->query->hasCode());
        $this->assertFalse($this->query->hasSegment());
        $this->assertSame(10000, $this->query->getMaxResults());
        $this->assertSame('dot', $this->query->getSep());
        $this->assertSame('fr', $this->query->getLng());
        $this->assertSame('total:displayed', $this->query->getInclude());
        $this->assertSame(1, $this->query->getPageNum());
    }

    public function testSpace()
    {
        $this->query->setSpace(475905);
        $this->assertSame(475905, $this->query->getSpace());
    }

    public function testL2()
    {
        $this->query->setL2(4);
        $this->assertSame(4, $this->query->getL2());
    }

    public function testStartDate()
    {
        $startDate = new \DateTime();
        $this->query->setStartDate($startDate);
        $this->assertSame($startDate, $this->query->getStartDate());
    }

    public function testEndDate()
    {
        $endDate = new \DateTime();
        $this->query->setEndDate($endDate);
        $this->assertSame($endDate, $this->query->getEndDate());
    }

    public function testColumns()
    {
        $columns = '{m_visits,m_page_loads}';
        $this->query->setColumns($columns);
        $this->assertSame($columns, $this->query->getColumns());
    }

    public function testSort()
    {
        $sort = array('-m_visits');
        $this->query->setSort($sort);
        $this->assertTrue($this->query->hasSort());
        $this->assertSame($sort, $this->query->getSort());
    }

    public function testFilter()
    {
        $filter = "d_l2:{eq:'slam'}";
        $this->query->setFilter($filter);
        $this->assertTrue($this->query->hasFilter());
        $this->assertSame($filter, $this->query->getFilter());
    }

    public function testPageNum()
    {
        $pageNum = 1;
        $this->query->setPageNum($pageNum);
        $this->assertSame($pageNum, $this->query->getPageNum());
    }

    public function testMaxResults()
    {
        $maxResults = 100;
        $this->query->setMaxResults($maxResults);
        $this->assertSame($maxResults, $this->query->getMaxResults());
    }

    public function testSep()
    {
        $sep = 'dot';
        $this->query->setSep($sep);
        $this->assertSame($sep, $this->query->getSep());
    }

    public function testLng()
    {
        $lng = 'fr';
        $this->query->setLng($lng);
        $this->assertSame($lng, $this->query->getLng());
    }

    public function testSample()
    {
        $sample = 'sample';
        $this->query->setSample($sample);
        $this->assertSame($sample, $this->query->getSample());
    }

    public function testCode()
    {
        $code = 'code';
        $this->query->setCode($code);
        $this->assertTrue($this->query->hasCode());
        $this->assertSame($code, $this->query->getCode());
    }

    public function testSegment()
    {
        $segment = 'foo';
        $this->query->setSegment($segment);
        $this->assertTrue($this->query->hasSegment());
        $this->assertSame($segment, $this->query->getSegment());
    }

    public function testInclude()
    {
        $include = 'include';
        $this->query->setInclude($include);
        $this->assertTrue($this->query->hasInclude());
        $this->assertSame($include, $this->query->getInclude());
    }

    public function testBuild()
    {
        $startDate = new \DateTime('2015-08-02');
        $endDate = new \DateTime('2015-08-02');
        $this->query->setColumns('{m_visits,m_page_loads}');
        $this->query->setSpace('475905');
        $this->query->setStartDate($startDate);
        $this->query->setEndDate($endDate);
        $this->query->setMaxResults(10000);
        $this->query->setPageNum(1);
        $this->query->setLng('fr');

        $expected = "https://apirest.atinternet-solutions.com/data/v2/json/getData?columns=%7Bm_visits%2Cm_page_loads%7D&space=%7Bs%3A475905%7D&period=%7BD%3A%7Bstart%3A%272015-08-02%27%2Cend%3A%272015-08-02%27%7D%7D&max-results=10000&page-num=1&include=%7Btotal%3Adisplayed%7D&lng=fr";
        $this->assertSame($expected, $this->query->build());
    }
}
