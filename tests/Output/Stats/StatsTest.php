<?php

namespace JmWri\Pubg\Test\Output\Stats;

use JmWri\Pubg\Output\Stats\RegionModeStats;
use JmWri\Pubg\Test\BaseTest;
use JmWri\Pubg\Test\DataFactory;

/**
 * Class StatsTest
 * @package JmWri\Pubg\Test\Output\Stats
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class StatsTest extends BaseTest
{
    /**
     * @var RegionModeStats
     */
    protected $stats;

    public function setUp()
    {
        $dataFactory = new DataFactory();
        $data = $dataFactory->getTestData(RegionModeStats::class);
        $this->stats = new RegionModeStats($data);
    }

    public function testDataIsSet()
    {
        $this->assertEquals('eu', $this->stats->getRegion());
        $this->assertEquals('2017-pre4', $this->stats->getSeason());
        $this->assertEquals('solo', $this->stats->getMatch());
        $this->assertCount(3, $this->stats->getStats());
    }
}
