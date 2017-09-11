<?php

namespace JmWri\Pubg\Test;

use GuzzleHttp\Exception\BadResponseException;
use JmWri\Pubg\Pubg;
use JmWri\Pubg\PubgException;
use Mockery as m;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;

/**
 * Class PubgTest
 * @package JmWri\Pubg\Test
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class PubgTest extends BaseTest
{
    /**
     * @param string $path
     * @return Response
     */
    public function getFileResponse($path)
    {
        $body = Psr7\stream_for(file_get_contents($path));
        return new Response(200, ['content-type' => 'application/json'], $body);
    }

    public function getGuzzleMock()
    {
        return m::mock('overload:GuzzleHttp\Client');
    }

    public function testSetApiKey()
    {
        $pubg = new Pubg('old_api_key');
        $this->assertEquals('old_api_key', $pubg->getApiKey());
        $pubg->setApiKey('new_api_key');
        $this->assertEquals('new_api_key', $pubg->getApiKey());
    }

    public function testSetApiKeyWithInvalid()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Pubg(null);
    }

    public function testGetPlayerStats()
    {
        $response = $this->getFileResponse(__DIR__ . '/data/get_player_stats.json');

        $requestMock = $this->getGuzzleMock();
        $requestMock->shouldReceive('request')
            ->once()
            ->with('GET', 'profile/pc/test_nickname', [
                'headers' => [
                    'TRN-Api-Key' => 'test_api_key'
                ],
                'query' => []
            ])
            ->andReturn($response);
        $pubg = new Pubg('test_api_key');
        $res = json_encode($pubg->getPlayerStats('test_nickname'));
        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/data/get_player_stats.json', $res);
    }

    public function testGetNickname()
    {
        $response = $this->getFileResponse(__DIR__ . '/data/get_nickname.json');

        $requestMock = $this->getGuzzleMock();
        $requestMock->shouldReceive('request')
            ->once()
            ->with('GET', 'search', [
                'headers' => [
                    'TRN-Api-Key' => 'test_api_key'
                ],
                'query' => [
                    'steamId' => 1234567890
                ]
            ])
            ->andReturn($response);
        $pubg = new Pubg('test_api_key');
        $res = json_encode($pubg->getNickname(1234567890));
        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/data/get_nickname.json', $res);
    }

    public function testHttpCodeError()
    {
        $this->expectException(PubgException::class);
        $response = new Response(500);

        $requestMock = $this->getGuzzleMock();
        $requestMock->shouldReceive('request')
            ->once()
            ->with('GET', 'search', [
                'headers' => [
                    'TRN-Api-Key' => 'test_api_key'
                ],
                'query' => [
                    'steamId' => 1234567890
                ]
            ])
            ->andReturn($response);
        $pubg = new Pubg('test_api_key');
        $res = json_encode($pubg->getNickname(1234567890));
        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/data/get_nickname.json', $res);
    }

    public function testGuzzleException()
    {
        $this->expectException(PubgException::class);

        $mockRequest = new Psr7\Request('test', 'test');
        $guzzleException = new BadResponseException('error message', $mockRequest);

        $requestMock = $this->getGuzzleMock();
        $requestMock->shouldReceive('request')
            ->once()
            ->with('GET', 'search', [
                'headers' => [
                    'TRN-Api-Key' => 'test_api_key'
                ],
                'query' => [
                    'steamId' => 1234567890
                ]
            ])
            ->andThrow($guzzleException);
        $pubg = new Pubg('test_api_key');
        $res = json_encode($pubg->getNickname(1234567890));
        $this->assertJsonStringEqualsJsonFile(__DIR__ . '/data/get_nickname.json', $res);
    }
}
