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

/**
 * Xiti analytics Query.
 *
 * @author ylcdx <yann@requestlab.fr>
 */
class Query
{

    const URL = 'https://apirest.atinternet-solutions.com/data/v2/json/getData';

    /**
     * Espace d'analyse
     *
     * @var
     */
    protected $space;

    /**
     * Espace d'analyse niveau 2
     *
     * @var string
     */
    protected $l2;

    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime
     */
    protected $endDate;

    /**
     * Liste des dimensions / métrique à récupérer
     *
     * @var string
     */
    protected $columns;

    /**
     * Liste des dimensions / métriques sur lesquelles trier les résultats
     *
     * @var array
     */
    protected $sort;

    /**
     * Filtre à appliquer
     *
     * @var
     */
    protected $filter;

    /**
     * Numéro de la page du jeu de résultat
     *
     * @var
     */
    protected $pageNum = 1;

    /**
     * Nombre de résultats dans la page de résultats
     *
     * @var
     */
    protected $maxResults = 10000;

    /**
     * Séparateur décimal (dot, comma)
     *
     * @var string
     */
    protected $sep = 'dot';

    /**
     * Langue des résutlats
     *
     * @var string
     */
    protected $lng = 'fr';

    /**
     * Prendre un échantillon de résultat (TOP N)
     *
     * @var integer
     */
    protected $sample;

    /**
     * Shortcode du template Data Query
     *
     * @var string
     */
    protected $code;

    /**
     * Segment appliqué sur le jeu de résultat
     *
     * @var string
     */
    protected $segment;

    /**
     * Pour obtenir des informations complémentaires (meta-data, total, etc.)
     *
     * @var
     */
    protected $include = 'total:displayed';

    /**
     * @return mixed
     */
    public function getSpace()
    {
        return $this->space;
    }

    /**
     * @param mixed $space
     */
    public function setSpace($space)
    {
        $this->space = $space;
    }

    /**
     * @return string
     */
    public function getL2()
    {
        return $this->l2;
    }

    /**
     * @param string $l2
     */
    public function setL2($l2)
    {
        $this->l2 = $l2;
    }

    /**
     * Checks pour Niveau 2.
     *
     * @return boolean TRUE s'il y a un niveau 2 sinon FALSE.
     */
    public function hasL2()
    {
        return !empty($this->l2);
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate = null)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return bool
     */
    public function hasStartDate()
    {
        return $this->startDate !== null;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate = null)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return bool
     */
    public function hasEndDate()
    {
        return $this->endDate !== null;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param string $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    /**
     * @return string
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param string $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return bool
     */
    public function hasSort(){
        return !empty($this->sort);
    }

    /**
     * @return string
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param string $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return bool
     */
    public function hasFilter()
    {
        return !empty($this->filter);
    }

    /**
     * @return integer
     */
    public function getPageNum()
    {
        return $this->pageNum;
    }

    /**
     * @param integer $pageNum
     */
    public function setPageNum($pageNum)
    {
        $this->pageNum = $pageNum;
    }

    /**
     * @return integer
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }

    /**
     * @param integer $maxResults
     */
    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
    }

    /**
     * @return string
     */
    public function getSep()
    {
        return $this->sep;
    }

    /**
     * @param string $sep
     */
    public function setSep($sep)
    {
        $this->sep = $sep;
    }

    /**
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param string $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * @return int
     */
    public function getSample()
    {
        return $this->sample;
    }

    /**
     * @param int $sample
     */
    public function setSample($sample)
    {
        $this->sample = $sample;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return bool
     */
    public function hasCode()
    {
        return !empty($this->code);
    }

    /**
     * @return string
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * @param string $segment
     */
    public function setSegment($segment)
    {
        $this->segment = $segment;
    }

    /**
     * Check segment
     *
     * @return bool
     */
    public function hasSegment()
    {
        return !empty($this->segment);
    }

    /**
     * @return mixed
     */
    public function getInclude()
    {
        return $this->include;
    }

    /**
     * @param mixed $include
     */
    public function setInclude($include)
    {
        $this->include = $include;
    }

    /**
     * @return bool
     */
    public function hasInclude()
    {
        return !empty($this->include);
    }

    /**
     * @return string
     */
    public function build()
    {
        $query = [
            'columns' => $this->getColumns(),
        ];
        $query['space'] = sprintf('{s:%s}', $this->getSpace());

        if ($this->hasL2()) {
            $query['space'] = sprintf('{l2s:{s:%s,l2:%s}}', $this->getSpace(), $this->getL2());
        }

        if ($this->hasSegment()) {
            $query['segment'] = $this->getSegment();
        }

        if ($this->hasCode()) {
            $query['code'] = $this->getCode();
        }

        $query['period'] = "{R:{D:'-1'}}";
        if ($this->hasStartDate() && $this->hasEndDate()) {
            $query['period'] = sprintf("{D:{start:'%s',end:'%s'}}", $this->getStartDate()->format('Y-m-d'), $this->getEndDate()->format('Y-m-d'));
        }

        if ($this->hasFilter()) {
            $query['filter'] = sprintf('{%s}', $this->getFilter());
        }

        $query['max-results'] = $this->getMaxResults();
        $query['page-num']    = $this->getPageNum();

        if ($this->hasInclude()) {
            $query['include'] = sprintf('{%s}', $this->getInclude());
        }

        $query['lng']         = $this->getLng();

        return sprintf('%s?%s', self::URL, http_build_query($query));
    }


}
