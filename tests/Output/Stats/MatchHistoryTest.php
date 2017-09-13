<?php

namespace JmWri\Pubg\Test\Output\Stats;

use JmWri\Pubg\Output\Stats\MatchHistory;
use JmWri\Pubg\Test\BaseTest;
use JmWri\Pubg\Test\DataFactory;

/**
 * Class MatchHistoryTest
 * @package JmWri\Pubg\Test\Output\Stats
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class MatchHistoryTest extends BaseTest
{
    /**
     * @var MatchHistory
     */
    protected $matchHistory;

    public function setUp()
    {
        $dataFactory = new DataFactory();
        $data = $dataFactory->getTestData(MatchHistory::class);
        $this->matchHistory = new MatchHistory($data);
    }

    public function testDataIsSet()
    {
        $this->assertEquals('2017-09-05 17:41:09', $this->matchHistory->getLastUpdated()->format('Y-m-d H:i:s'));
        $this->assertEquals(4, $this->matchHistory->getSeason());
        $this->assertEquals('Early Access Season #4', $this->matchHistory->getSeasonDisplay());
        $this->assertEquals(2, $this->matchHistory->getMatch());
        $this->assertEquals('Duo', $this->matchHistory->getMatchDisplay());
        $this->assertEquals(2, $this->matchHistory->getRegion());
        $this->assertEquals('[EU] Europe', $this->matchHistory->getRegionDisplay());
        $this->assertEquals(4, $this->matchHistory->getRounds());
        $this->assertEquals(0, $this->matchHistory->getWins());
        $this->assertEquals(2, $this->matchHistory->getKills());
        $this->assertEquals(1, $this->matchHistory->getAssists());
        $this->assertEquals(2, $this->matchHistory->getTop10());
        $this->assertEquals(1270.2, $this->matchHistory->getRating());
        $this->assertEquals(1270.2, $this->matchHistory->getRatingChange());
        $this->assertEquals(256368, $this->matchHistory->getRatingRank());
        $this->assertEquals(256368, $this->matchHistory->getRatingRankChange());
        $this->assertEquals(0, $this->matchHistory->getHeadShots());
        $this->assertEquals(0.5, $this->matchHistory->getKd());
        $this->assertEquals(463, $this->matchHistory->getDamage());
        $this->assertEquals(4333.51, $this->matchHistory->getTimeSurvived());
        $this->assertEquals(1063, $this->matchHistory->getWinRating());
        $this->assertEquals(1063, $this->matchHistory->getWinRatingChange());
        $this->assertEquals(240738, $this->matchHistory->getWinRank());
        $this->assertEquals(240738, $this->matchHistory->getWinRankChange());
        $this->assertEquals(1035, $this->matchHistory->getKillRating());
        $this->assertEquals(1035, $this->matchHistory->getKillRatingChange());
        $this->assertEquals(346508, $this->matchHistory->getKillRank());
        $this->assertEquals(346508, $this->matchHistory->getKillRankChange());
        $this->assertEquals(12239.68, $this->matchHistory->getMoveDistance());
    }
}
