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
     * @param int $status
     * @param string $contentType
     * @return Response
     */
    public function getFileResponse($path, $status = 200, $contentType = 'application/json')
    {
        $body = Psr7\stream_for(file_get_contents($path));
        return new Response($status, ['Content-Type' => $contentType], $body);
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
        $stats = $pubg->getPlayerStats('test_nickname');
        $this->assertEquals('account.test_account_id', $stats->getAccountId());
        $this->assertEquals('test_nickname', $stats->getNickname());
        $this->assertEquals(
            'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/test_avatar.jpg',
            $stats->getAvatarUrl()
        );
        $this->assertEquals('eu', $stats->getSelectedRegion());
        $this->assertEquals('2017-pre4', $stats->getDefaultSeason());
        $this->assertEquals('Early Access Season #4', $stats->getSeasonDisplay());
        $this->assertEquals('2017-09-06 07:01:27', $stats->getLastUpdated()->format('Y-m-d H:i:s'));
        $this->assertEquals(1139990, $stats->getTrackerId());
        $this->assertCount(4, $stats->getRegionModeStats());
        m::close();
    }

    public function testGetPlayerStatsNoPlayer()
    {
        $this->expectException(PubgException::class);
        $response = $this->getFileResponse(__DIR__ . '/data/get_player_stats_no_player.json');

        $requestMock = $this->getGuzzleMock();
        $requestMock->shouldReceive('request')
            ->once()
            ->with('GET', 'profile/pc/hopefully_not_exist', [
                'headers' => [
                    'TRN-Api-Key' => 'test_api_key'
                ],
                'query' => []
            ])
            ->andReturn($response);
        $pubg = new Pubg('test_api_key');
        $pubg->getPlayerStats('hopefully_not_exist');
        m::close();
    }

    public function testGetAccount()
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
        $account = $pubg->getAccount(1234567890);
        $this->assertEquals('account.test_account_id', $account->getAccountId());
        $this->assertEquals('test_nickname', $account->getNickname());
        $this->assertEquals(
            'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/test_avatar.jpg',
            $account->getAvatarUrl()
        );
        $this->assertEquals(1234567890, $account->getSteamId());
        $this->assertEquals('test_steam_name', $account->getSteamName());
        $this->assertEquals('offline', $account->getState());
        $this->assertEquals(false, $account->isInviteAllowed());
        m::close();
    }

    public function testGetAccountNoAccount()
    {
        $this->expectException(\JmWri\Pubg\BadResponseException::class);
        $response = $this->getFileResponse(__DIR__ . '/data/html_reponse.html', 200, 'text/html');

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
        $pubg->getAccount(1234567890);
        m::close();
    }

    public function testHttpCodeError()
    {
        $this->expectException(PubgException::class);
        $response = new Response(500, ['Content-Type' => 'application/json'], 'Something terrible happened.');

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
        $pubg->getAccount(1234567890);
        m::close();
    }

    public function testHttpCodeErrorWithJsonBody()
    {
        $this->expectException(PubgException::class);
        $response = $this->getFileResponse(__DIR__ . '/data/http_error_with_json_body.json', 500);

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
        $pubg->getAccount(1234567890);
        m::close();
    }

    public function testHttpCodeErrorWithUncommonJsonBody()
    {
        $this->expectException(PubgException::class);
        $response = $this->getFileResponse(__DIR__ . '/data/http_error_with_uncommon_json_body.json', 200);

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
        $pubg->getAccount(1234567890);
        m::close();
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
        $pubg->getAccount(1234567890);
        m::close();
    }
}
