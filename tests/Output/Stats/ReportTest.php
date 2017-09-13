<?php

namespace JmWri\Pubg\Test\Output\Stats;

use JmWri\Pubg\Output\Stats\Report;
use JmWri\Pubg\Test\BaseTest;
use JmWri\Pubg\Test\DataFactory;

/**
 * Class ReportTest
 * @package JmWri\Pubg\Test\Output\Stats
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class ReportTest extends BaseTest
{
    /**
     * @var Report
     */
    protected $report;

    public function setUp()
    {
        $dataFactory = new DataFactory();
        $data = $dataFactory->getTestData(Report::class);
        $this->report = new Report($data);
    }

    public function testDataIsSet()
    {
        $this->assertEquals('test_account_id', $this->report->getAccountId());
        $this->assertEquals('test_avatar', $this->report->getAvatarUrl());
        $this->assertEquals('region', $this->report->getSelectedRegion());
        $this->assertEquals('season', $this->report->getDefaultSeason());
        $this->assertEquals('season_display', $this->report->getSeasonDisplay());
        $this->assertEquals('2017-09-06 07:01:27', $this->report->getLastUpdated()->format('Y-m-d H:i:s'));
        $this->assertEquals('test_nickname', $this->report->getNickname());
        $this->assertEquals(1139990, $this->report->getTrackerId());
        $this->assertCount(3, $this->report->getStats());
        $this->assertCount(3, $this->report->getMatchHistory());
    }
}
