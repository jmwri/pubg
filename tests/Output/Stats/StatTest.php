<?php

namespace JmWri\Pubg\Test\Output\Stats;

use JmWri\Pubg\Output\Stats\Stat;
use JmWri\Pubg\Test\BaseTest;
use JmWri\Pubg\Test\DataFactory;

/**
 * Class StatTest
 * @package JmWri\Pubg\Test\Output\Stats
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class StatTest extends BaseTest
{
    /**
     * @var Stat
     */
    protected $stat;

    public function setUp()
    {
        $dataFactory = new DataFactory();
        $data = $dataFactory->getTestData(Stat::class);
        $this->stat = new Stat($data);
    }

    public function testDataIsSet()
    {
        $this->assertEquals('Rating', $this->stat->getLabel());
        $this->assertEquals('Rating', $this->stat->getField());
        $this->assertEquals('Skill Rating', $this->stat->getCategory());
        $this->assertNull($this->stat->getValueInt());
        $this->assertEquals(1181.0, $this->stat->getValueDec());
        $this->assertEquals('1181', $this->stat->getValueStr());
        $this->assertEquals(802350, $this->stat->getRank());
        $this->assertEquals(91.0, $this->stat->getPercentile());
        $this->assertEquals('1,181', $this->stat->getDisplayValue());
    }
}
