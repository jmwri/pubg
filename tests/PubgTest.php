<?php

namespace JmWri\Pubg\Test;

use JmWri\Pubg\Pubg;


/**
 * Class PubgTest
 * @package JmWri\Pubg\Test
 */
class PubgTest extends BaseTest
{
    /**
     * @var Pubg
     */
    protected static $pubg;

    public function setUp()
    {
        self::$pubg = $this->getMockBuilder(Pubg::class)
            ->setConstructorArgs(['test_api_key'])
            ->setMethods(['getPlayerStats', 'getNickname'])
            ->getMock();
        self::$pubg->expects($this->any())
            ->method('getPlayerStats')
            ->will($this->returnValueMap([
                ['test_nickname', json_decode(file_get_contents(__DIR__.'/data/get_player_stats.json'))]
            ]));
        self::$pubg->expects($this->any())
            ->method('getNickname')
            ->will($this->returnValueMap([
                [1234567890, json_decode(file_get_contents(__DIR__.'/data/get_nickname.json'))]
            ]));
    }

    public function testGetPlayerStats()
    {
        $res = json_encode(self::$pubg->getPlayerStats('test_nickname'));
        $this->assertJsonStringEqualsJsonFile(__DIR__.'/data/get_player_stats.json', $res);
    }

    public function testGetNickname()
    {
        $res = json_encode(self::$pubg->getNickname(1234567890));
        $this->assertJsonStringEqualsJsonFile(__DIR__.'/data/get_nickname.json', $res);
    }
}
