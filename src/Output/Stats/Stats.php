<?php

namespace JmWri\Pubg\Output\Stats;

/**
 * Class Stats
 * @package JmWri\Pubg\Output\Stats
 */
class Stats
{
    /**
     * @var string
     */
    protected $region;

    /**
     * @var string
     */
    protected $season;

    /**
     * @var string
     */
    protected $match;

    /**
     * @var Stat[]
     */
    protected $stats;

    /**
     * Stats constructor.
     *
     * @param [] $data
     */
    public function __construct($data)
    {
        $this->setRegion($data['Region']);
        $this->setSeason($data['Season']);
        $this->setMatch($data['Match']);

        foreach ($data['Stats'] as $statData) {
            $statObj = new Stat($statData);
            $this->appendStat($statObj);
        }
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    protected function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param string $season
     */
    protected function setSeason($season)
    {
        $this->season = $season;
    }

    /**
     * @return string
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param string $match
     */
    protected function setMatch($match)
    {
        $this->match = $match;
    }

    /**
     * @return Stat[]
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @param Stat $stat
     */
    protected function appendStat($stat)
    {
        $this->stats[] = $stat;
    }
}
