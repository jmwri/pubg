<?php

namespace JmWri\Pubg\Test;

use JmWri\Pubg\Output\Account;
use JmWri\Pubg\Output\Stats\MatchHistory;
use JmWri\Pubg\Output\Stats\Report;
use JmWri\Pubg\Output\Stats\Stat;
use JmWri\Pubg\Output\Stats\RegionModeStats;

class DataFactory
{
    /**
     * @param string $cls
     * @param null|int $n
     * @return array
     */
    public function getTestData($cls, $n = null)
    {
        $extraStr = '';
        if (!is_null($n)) {
            $extraStr = "{$n}";
        }
        switch ($cls) {
            case Account::class:
                return [
                    'AccountId' => 'test_account_id',
                    'Nickname' => 'test_nickname',
                    'AvatarUrl' => 'test_avatar_url',
                    'SteamId' => 1234,
                    'SteamName' => 'test_steam_name',
                    'State' => 'test_state',
                    'InviteAllow' => true,
                ];
            case Stat::class:
                return [
                    'label' => 'Rating' . $extraStr,
                    'field' => 'Rating' . $extraStr,
                    'category' => 'Skill Rating' . $extraStr,
                    'ValueInt' => null,
                    'ValueDec' => 1181.0,
                    'value' => '1181',
                    'rank' => 802350,
                    'percentile' => 91.0,
                    'displayValue' => '1,181',
                ];
            case RegionModeStats::class:
                return [
                    'Region' => 'eu' . $extraStr,
                    'Season' => '2017-pre4' . $extraStr,
                    'Match'=> 'solo' . $extraStr,
                    'Stats' => $this->getNTestData(Stat::class, 3),
                ];
            case Report::class:
                return [
                    'AccountId' => 'test_account_id' . $extraStr,
                    'Avatar' => 'test_avatar' . $extraStr,
                    'selectedRegion' => 'region' . $extraStr,
                    'defaultSeason' => 'season' . $extraStr,
                    'seasonDisplay' => 'season_display' . $extraStr,
                    'LastUpdated' => '2017-09-06T07:01:27.0034291Z',
                    'PlayerName' => 'test_nickname' . $extraStr,
                    'PubgTrackerId' => 1139990,
                    'Stats' => $this->getNTestData(RegionModeStats::class, 3),
                    'MatchHistory' => $this->getNTestData(MatchHistory::class, 3),
                ];
            case MatchHistory::class:
                return [
                    'Id' => 11468646,
                    'Updated' => '2017-09-05T17:41:09.65' . $extraStr,
                    'UpdatedJS' => '1504633269650' . $extraStr,
                    'Season' => 4,
                    'SeasonDisplay' => 'Early Access Season #4' . $extraStr,
                    'Match' => 2,
                    'MatchDisplay' => 'Duo' . $extraStr,
                    'Region' => 2,
                    'RegionDisplay' => '[EU] Europe' . $extraStr,
                    'Rounds' => 4,
                    'Wins' => 0,
                    'Kills' => 2,
                    'Assists' => 1,
                    'Top10' => 2,
                    'Rating' => 1270.2,
                    'RatingChange' => 1270.2,
                    'RatingRank' => 256368,
                    'RatingRankChange' => 256368,
                    'Headshots' => 0,
                    'Kd' => 0.5,
                    'Damage' => 463,
                    'TimeSurvived' => 4333.51,
                    'WinRating' => 1063,
                    'WinRank' => 240738,
                    'WinRatingChange' => 1063,
                    'WinRatingRankChange' => 240738,
                    'KillRating' => 1035,
                    'KillRank' => 346508,
                    'KillRatingChange' => 1035,
                    'KillRatingRankChange' => 346508,
                    'MoveDistance' => 12239.68
                ];
        }
        throw new \InvalidArgumentException("Unhandled class: {$cls}");
    }

    /**
     * @param string $cls
     * @param int $n
     * @return array
     */
    public function getNTestData($cls, $n)
    {
        $res = [];
        for ($i = 1; $i <= $n; $i++) {
            $res[] = $this->getTestData($cls, $i);
        }
        return $res;
    }
}