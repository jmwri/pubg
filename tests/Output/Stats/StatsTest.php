<?php

namespace JmWri\Pubg\Test\Output\Stats;

use JmWri\Pubg\Output\Stats\Stats;
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
     * @var Stats
     */
    protected $stats;

    public function setUp()
    {
        $dataFactory = new DataFactory();
        $data = $dataFactory->getTestData(Stats::class);
        $this->stats = new Stats($data);
    }

    public function testDataIsSet()
    {
        $this->assertEquals('eu', $this->stats->getRegion());
        $this->assertEquals('2017-pre4', $this->stats->getSeason());
        $this->assertEquals('solo', $this->stats->getMatch());
        $this->assertCount(3, $this->stats->getStats());
    }
}
