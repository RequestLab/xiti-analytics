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
 * Xiti analytics Service.
 *
 * @author ylcdx <yann@requestlab.fr>
 */
class Service
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param Query $query
     * @return Response
     * @throws XitiException
     */
    public function query(Query $query, $clientRequestId = null)
    {
        $headers = $this->getClient()->getHeaders($clientRequestId);
        $uri     = $query->build();
        $content = $this->getClient()->getHttpAdapter()->getContent($uri, $headers);
        if (is_object($content)) {
            $content = $content->getBody();
        }
        $json = json_decode($content, true);
        if (!is_array($json) || isset($json['ErrorCode'])) {
            throw XitiException::invalidQuery(isset($json['ErrorCode']) ? $json['ErrorMessage'] : 'Invalid json');
        }

        return new Response($json);
    }
}