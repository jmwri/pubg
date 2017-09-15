<?php

namespace JmWri\Pubg;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JmWri\Pubg\Output\Account;
use JmWri\Pubg\Output\Stats\Report;

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
    public function __construct($apiKey)
    {
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
        if (!is_string($apiKey)) {
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
    public function request($method, $uri, $params = [])
    {
        try {
            $response = $this->client->request($method, $uri, [
                'headers' => [
                    'TRN-Api-Key' => $this->getApiKey()
                ],
                'query' => $params
            ]);
        } catch (GuzzleException $e) {
            throw new PubgException($e->getMessage(), $e->getCode());
        }
        if ($response->getHeader('Content-Type')[0] != 'application/json') {
            throw new BadResponseException('Unable to parse response', $response->getStatusCode());
        }
        $body = json_decode((string)$response->getBody(), true);
        if (is_null($body)) {
            throw new PubgException($response->getBody(), $response->getStatusCode());
        }
        if (array_key_exists('error', $body) && $body['error']) {
            $message = 'An error occurred';
            if (array_key_exists('message', $body)) {
                $message = $body['message'];
            }
            throw new PubgException($message, $response->getStatusCode());
        }
        return $body;
    }

    /**
     * @param string $nickname
     * @return Report
     */
    public function getPlayerStats($nickname)
    {
        $result = $this->request('GET', "profile/pc/{$nickname}");
        return new Report($result);
    }

    /**
     * @param int $steamId 64 bit Steam ID
     * @return Account
     */
    public function getAccount($steamId)
    {
        $result = $this->request('GET', "search", [
            'steamId' => $steamId
        ]);
        return new Account($result);
    }
}
