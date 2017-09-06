<?php

namespace JmWri\Pubg;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Pubg
 * @package JmWri\Pubg
 */
class Pubg
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var Client
     */
    private $client;

    /**
     * Pubg constructor.
     *
     * @param string $apiKey
     */
    public function __construct($apiKey) {
        $this->setApiKey($apiKey);
        $this->client = new Client([
            'base_uri' => 'https://pubgtracker.com/api/'
        ]);
    }

    /**
     * @param string $apiKey
     *
     * @throws \InvalidArgumentException
     */
    public function setApiKey($apiKey)
    {
        if (! is_string($apiKey)) {
            throw new \InvalidArgumentException("The specified API key must be a string: {$apiKey}");
        }

        $this->apiKey = $apiKey;
    }
    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param [] $params
     * @return mixed
     * @throws PubgException
     */
    public function request($method, $uri, $params=[])
    {
        try {
            $res = $this->client->request($method, $uri, [
                'headers' => [
                    'TRN-Api-Key' => $this->getApiKey()
                ],
                'query' => $params
            ]);
        } catch(GuzzleException $e) {
            throw new PubgException($e->getMessage(), $e->getCode());
        }
        if ($res->getStatusCode() != 200) {
            throw new PubgException($res->getBody(), $res->getStatusCode());
        }
        return json_decode((string) $res->getBody());
    }

    /**
     * @param string $nickname
     * @return mixed
     */
    public function getPlayerStats($nickname)
    {
        return $this->request('GET', "profile/pc/{$nickname}");
    }

    /**
     * @param int $steamId 64 bit Steam ID
     * @return mixed
     */
    public function getNickname($steamId)
    {
        return $this->request('GET', "search", [
            'steamId' => $steamId
        ]);
    }

}
