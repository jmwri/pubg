<?php

namespace JmWri\Pubg\Output\Stats;

/**
 * Class Report
 * @package JmWri\Pubg\Output\Stats
 */
class Report
{
    /**
     * @var string
     */
    protected $accountId;

    /**
     * @var string
     */
    protected $nickname;

    /**
     * @var string
     */
    protected $avatarUrl;

    /**
     * @var string
     */
    protected $selectedRegion;

    /**
     * @var string
     */
    protected $defaultSeason;

    /**
     * @var string
     */
    protected $seasonDisplay;

    /**
     * @var \DateTime
     */
    protected $lastUpdated;

    /**
     * @var int
     */
    protected $trackerId;

    /**
     * @var RegionModeStats[]
     */
    protected $regionModeStats;

    /**
     * @var MatchHistory[]
     */
    protected $matchHistory;

    /**
     * Stats constructor.
     *
     * @param array $data
     */
    public function __construct($data)
    {
        $this->setAccountId($data['AccountId']);
        $this->setNickname($data['PlayerName']);
        $this->setAvatarUrl($data['Avatar']);
        $this->setSelectedRegion($data['selectedRegion']);
        $this->setDefaultSeason($data['defaultSeason']);
        $this->setSeasonDisplay($data['seasonDisplay']);
        $timezone = new \DateTimeZone('UTC');
        $lastUpdated = new \DateTime($data['LastUpdated'], $timezone);
        $this->setLastUpdated($lastUpdated);
        $this->setTrackerId($data['PubgTrackerId']);

        foreach ($data['Stats'] as $stats) {
            $this->appendStats(new RegionModeStats($stats));
        }

        foreach ($data['MatchHistory'] as $matchHistory) {
            $this->appendMatchHistory(new MatchHistory($matchHistory));
        }
    }

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     */
    protected function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     */
    protected function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * @param string $avatarUrl
     */
    protected function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;
    }

    /**
     * @return string
     */
    public function getSelectedRegion()
    {
        return $this->selectedRegion;
    }

    /**
     * @param string $selectedRegion
     */
    protected function setSelectedRegion($selectedRegion)
    {
        $this->selectedRegion = $selectedRegion;
    }

    /**
     * @return string
     */
    public function getDefaultSeason()
    {
        return $this->defaultSeason;
    }

    /**
     * @param string $defaultSeason
     */
    protected function setDefaultSeason($defaultSeason)
    {
        $this->defaultSeason = $defaultSeason;
    }

    /**
     * @return string
     */
    public function getSeasonDisplay()
    {
        return $this->seasonDisplay;
    }

    /**
     * @param string $seasonDisplay
     */
    protected function setSeasonDisplay($seasonDisplay)
    {
        $this->seasonDisplay = $seasonDisplay;
    }

    /**
     * @return \DateTime
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * @param \DateTime $lastUpdated
     */
    protected function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;
    }

    /**
     * @return int
     */
    public function getTrackerId()
    {
        return $this->trackerId;
    }

    /**
     * @param int $trackerId
     */
    protected function setTrackerId($trackerId)
    {
        $this->trackerId = $trackerId;
    }

    /**
     * @param mixed $item
     * @return array
     */
    protected function toArray($item)
    {
        if (!is_array($item) && !is_null($item)) {
            return [$item];
        }
        return $item;
    }

    /**
     * @param null|string|string[] $region
     * @param null|string|string[] $mode
     * @return RegionModeStats[]
     */
    public function getRegionModeStats($region = null, $mode = null)
    {
        $region = $this->toArray($region);
        $mode = $this->toArray($mode);
        $regionModeStats = [];
        foreach ($this->regionModeStats as $regionModeStat) {
            if (! is_null($region) && !in_array($regionModeStat->getRegion(), $region)) {
                continue;
            }
            if (! is_null($mode) && !in_array($regionModeStat->getMatch(), $mode)) {
                continue;
            }
            $regionModeStats[] = $regionModeStat;
        }
        return $regionModeStats;
    }

    /**
     * @param RegionModeStats $stats
     */
    protected function appendStats($stats)
    {
        $this->regionModeStats[] = $stats;
    }

    /**
     * @return MatchHistory[]
     */
    public function getMatchHistory()
    {
        return $this->matchHistory;
    }

    /**
     * @param MatchHistory $matchHistory
     */
    protected function appendMatchHistory($matchHistory)
    {
        $this->matchHistory[] = $matchHistory;
    }

    /**
     * @param null|string $region
     * @param null|string $mode
     * @return array
     */
    public function getStats($region = null, $mode = null)
    {
        $stats = [];
        $regionModeStats = $this->getRegionModeStats($region, $mode);
        foreach ($regionModeStats as $regionModeStat) {
            $stats = array_merge($stats, $regionModeStat->getStats());
        }
        return $stats;
    }
}
