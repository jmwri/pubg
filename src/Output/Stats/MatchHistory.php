<?php

namespace JmWri\Pubg\Output\Stats;

/**
 * Class MatchHistory
 * @package JmWri\Pubg\Output\Stats
 */
class MatchHistory
{
    /**
     * @var \DateTime
     */
    protected $lastUpdated;

    /**
     * @var int
     */
    protected $season;

    /**
     * @var string
     */
    protected $seasonDisplay;

    /**
     * @var int
     */
    protected $match;

    /**
     * @var string
     */
    protected $matchDisplay;

    /**
     * @var int
     */
    protected $region;

    /**
     * @var string
     */
    protected $regionDisplay;

    /**
     * @var int
     */
    protected $rounds;

    /**
     * @var int
     */
    protected $wins;

    /**
     * @var int
     */
    protected $kills;

    /**
     * @var int
     */
    protected $assists;

    /**
     * @var int
     */
    protected $top10;

    /**
     * @var float
     */
    protected $rating;

    /**
     * @var float
     */
    protected $ratingChange;

    /**
     * @var float
     */
    protected $ratingRank;

    /**
     * @var float
     */
    protected $ratingRankChange;

    /**
     * @var int
     */
    protected $headShots;

    /**
     * @var float
     */
    protected $kdRatio;

    /**
     * @var int
     */
    protected $damage;

    /**
     * @var int
     */
    protected $timeSurvived;

    /**
     * @var int
     */
    protected $winRating;

    /**
     * @var int
     */
    protected $winRatingChange;

    /**
     * @var int
     */
    protected $winRank;

    /**
     * @var int
     */
    protected $winRankChange;

    /**
     * @var int
     */
    protected $killRating;

    /**
     * @var int
     */
    protected $killRatingChange;

    /**
     * @var int
     */
    protected $killRank;

    /**
     * @var int
     */
    protected $killRankChange;

    /**
     * @var float
     */
    protected $moveDistance;

    /**
     * Stats constructor.
     *
     * @param [] $data
     */
    public function __construct($data)
    {
        $timezone = new \DateTimeZone('UTC');
        $this->setLastUpdated(new \DateTime($data['Updated'], $timezone));
        $this->setSeason($data['Season']);
        $this->setSeasonDisplay($data['SeasonDisplay']);
        $this->setMatch($data['Match']);
        $this->setMatchDisplay($data['MatchDisplay']);
        $this->setRegion($data['Region']);
        $this->setRegionDisplay($data['RegionDisplay']);
        $this->setRounds($data['Rounds']);
        $this->setWins($data['Wins']);
        $this->setKills($data['Kills']);
        $this->setAssists($data['Assists']);
        $this->setTop10($data['Top10']);
        $this->setRating($data['Rating']);
        $this->setRatingChange($data['RatingChange']);
        $this->setRatingRank($data['RatingRank']);
        $this->setRatingRankChange($data['RatingRankChange']);
        $this->setHeadShots($data['Headshots']);
        $this->setKdRatio($data['Kd']);
        $this->setDamage($data['Damage']);
        $this->setTimeSurvived($data['TimeSurvived']);
        $this->setWinRating($data['WinRating']);
        $this->setWinRatingChange($data['WinRatingChange']);
        $this->setWinRank($data['WinRank']);
        $this->setWinRankChange($data['WinRatingRankChange']);
        $this->setKillRating($data['KillRating']);
        $this->setKillRatingChange($data['KillRatingChange']);
        $this->setKillRank($data['KillRank']);
        $this->setKillRankChange($data['KillRatingRankChange']);
        $this->setMoveDistance($data['MoveDistance']);
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
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param int $season
     */
    protected function setSeason($season)
    {
        $this->season = $season;
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
     * @return int
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param int $match
     */
    protected function setMatch($match)
    {
        $this->match = $match;
    }

    /**
     * @return string
     */
    public function getMatchDisplay()
    {
        return $this->matchDisplay;
    }

    /**
     * @param string $matchDisplay
     */
    protected function setMatchDisplay($matchDisplay)
    {
        $this->matchDisplay = $matchDisplay;
    }

    /**
     * @return int
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param int $region
     */
    protected function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getRegionDisplay()
    {
        return $this->regionDisplay;
    }

    /**
     * @param string $regionDisplay
     */
    protected function setRegionDisplay($regionDisplay)
    {
        $this->regionDisplay = $regionDisplay;
    }

    /**
     * @return int
     */
    public function getRounds()
    {
        return $this->rounds;
    }

    /**
     * @param int $rounds
     */
    protected function setRounds($rounds)
    {
        $this->rounds = $rounds;
    }

    /**
     * @return int
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * @param int $wins
     */
    protected function setWins($wins)
    {
        $this->wins = $wins;
    }

    /**
     * @return int
     */
    public function getKills()
    {
        return $this->kills;
    }

    /**
     * @param int $kills
     */
    protected function setKills($kills)
    {
        $this->kills = $kills;
    }

    /**
     * @return int
     */
    public function getAssists()
    {
        return $this->assists;
    }

    /**
     * @param int $assists
     */
    protected function setAssists($assists)
    {
        $this->assists = $assists;
    }

    /**
     * @return int
     */
    public function getTop10()
    {
        return $this->top10;
    }

    /**
     * @param int $top10
     */
    protected function setTop10($top10)
    {
        $this->top10 = $top10;
    }

    /**
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     */
    protected function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return float
     */
    public function getRatingChange()
    {
        return $this->ratingChange;
    }

    /**
     * @param float $ratingChange
     */
    protected function setRatingChange($ratingChange)
    {
        $this->ratingChange = $ratingChange;
    }

    /**
     * @return float
     */
    public function getRatingRank()
    {
        return $this->ratingRank;
    }

    /**
     * @param float $ratingRank
     */
    protected function setRatingRank($ratingRank)
    {
        $this->ratingRank = $ratingRank;
    }

    /**
     * @return float
     */
    public function getRatingRankChange()
    {
        return $this->ratingRankChange;
    }

    /**
     * @param float $ratingRankChange
     */
    protected function setRatingRankChange($ratingRankChange)
    {
        $this->ratingRankChange = $ratingRankChange;
    }

    /**
     * @return int
     */
    public function getHeadShots()
    {
        return $this->headShots;
    }

    /**
     * @param int $headShots
     */
    protected function setHeadShots($headShots)
    {
        $this->headShots = $headShots;
    }

    /**
     * @return float
     */
    public function getKdRatio()
    {
        return $this->kdRatio;
    }

    /**
     * @param float $kdRatio
     */
    protected function setKdRatio($kdRatio)
    {
        $this->kdRatio = $kdRatio;
    }

    /**
     * @return int
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @param int $damage
     */
    protected function setDamage($damage)
    {
        $this->damage = $damage;
    }

    /**
     * @return int
     */
    public function getTimeSurvived()
    {
        return $this->timeSurvived;
    }

    /**
     * @param int $timeSurvived
     */
    protected function setTimeSurvived($timeSurvived)
    {
        $this->timeSurvived = $timeSurvived;
    }

    /**
     * @return int
     */
    public function getWinRating()
    {
        return $this->winRating;
    }

    /**
     * @param int $winRating
     */
    protected function setWinRating($winRating)
    {
        $this->winRating = $winRating;
    }

    /**
     * @return int
     */
    public function getWinRatingChange()
    {
        return $this->winRatingChange;
    }

    /**
     * @param int $winRatingChange
     */
    protected function setWinRatingChange($winRatingChange)
    {
        $this->winRatingChange = $winRatingChange;
    }

    /**
     * @return int
     */
    public function getWinRank()
    {
        return $this->winRank;
    }

    /**
     * @param int $winRank
     */
    protected function setWinRank($winRank)
    {
        $this->winRank = $winRank;
    }

    /**
     * @return int
     */
    public function getWinRankChange()
    {
        return $this->winRankChange;
    }

    /**
     * @param int $winRankChange
     */
    protected function setWinRankChange($winRankChange)
    {
        $this->winRankChange = $winRankChange;
    }

    /**
     * @return int
     */
    public function getKillRating()
    {
        return $this->killRating;
    }

    /**
     * @param int $killRating
     */
    protected function setKillRating($killRating)
    {
        $this->killRating = $killRating;
    }

    /**
     * @return int
     */
    public function getKillRatingChange()
    {
        return $this->killRatingChange;
    }

    /**
     * @param int $killRatingChange
     */
    protected function setKillRatingChange($killRatingChange)
    {
        $this->killRatingChange = $killRatingChange;
    }

    /**
     * @return int
     */
    public function getKillRank()
    {
        return $this->killRank;
    }

    /**
     * @param int $killRank
     */
    protected function setKillRank($killRank)
    {
        $this->killRank = $killRank;
    }

    /**
     * @return int
     */
    public function getKillRankChange()
    {
        return $this->killRankChange;
    }

    /**
     * @param int $killRankChange
     */
    protected function setKillRankChange($killRankChange)
    {
        $this->killRankChange = $killRankChange;
    }

    /**
     * @return float
     */
    public function getMoveDistance()
    {
        return $this->moveDistance;
    }

    /**
     * @param float $moveDistance
     */
    protected function setMoveDistance($moveDistance)
    {
        $this->moveDistance = $moveDistance;
    }
}
