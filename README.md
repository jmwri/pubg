# PUBG

[![Build Status](https://travis-ci.org/jmwri/pubg-php.svg?branch=master)](https://travis-ci.org/jmwri/pubg-php)
[![Total Downloads](https://poser.pugx.org/jmwri/pubg-php/d/total.svg)](https://packagist.org/packages/jmwri/pubg-php)
[![Latest Stable Version](https://poser.pugx.org/jmwri/pubg-php/v/stable.svg)](https://packagist.org/packages/jmwri/pubg-php)
[![Latest Unstable Version](https://poser.pugx.org/jmwri/pubg-php/v/unstable.svg)](https://packagist.org/packages/jmwri/pubg-php)
[![License](https://poser.pugx.org/jmwri/pubg-php/license.svg)](https://packagist.org/packages/jmwri/pubg-php)
[![Code Climate](https://codeclimate.com/github/jmwri/pubg-php/badges/gpa.svg)](https://codeclimate.com/github/jmwri/pubg-php)
[![Test Coverage](https://codeclimate.com/github/jmwri/pubg-php/badges/coverage.svg)](https://codeclimate.com/github/jmwri/pubg-php/coverage)
[![Issue Count](https://codeclimate.com/github/jmwri/pubg-php/badges/issue_count.svg)](https://codeclimate.com/github/jmwri/pubg-php)

**https://github.com/jmwri/pubg-php**

This package is a wrapper around [PUBG Tracker's API](https://pubgtracker.com/site-api).

Please obide by the rate limits specified by PUBG Tracker.

# Getting started
## Installation
    composer require jmwri/pubg-php
    
## API key
You will need to get an API key from [PUBG Tracker](https://pubgtracker.com/site-api).

# Usage
## Get account
This example is based off of the [test data](tests/data/get_nickname.json).
```php
$pubg = new Pubg('my-api-key');
$pubg->getAccount(1234567890);
$account = $pubg->getAccount(1234567890);
$account->getAccountId(); // 'account.test_account_id'
$account->getNickname(); // 'test_nickname'
$account->getAvatarUrl(); // 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/test_avatar.jpg'
$account->getSteamId(); // 1234567890
$account->getSteamName(); // 'test_steam_name'
$account->getState(); // 'offline'
$account->getInviteAllow(); // false
```

## Get player stats
This is trimmed output. See [get_player_stats.json](tests/data/get_player_stats.json) for full output.
```php
$pubg = new Pubg('my-api-key');
$pubg->getPlayerStats('test_nickname');
```
```json
{
  "platformId": 4,
  "AccountId": "account.test_account_id",
  "Avatar": "https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/test_avatar.jpg",
  "selectedRegion": "eu",
  "defaultSeason": "2017-pre4",
  "seasonDisplay": "Early Access Season #4",
  "LastUpdated": "2017-09-06T07:01:27.0034291Z",
  "PlayerName": "test_nickname",
  "PubgTrackerId": 1144444,
  "Stats": [
    {
      "Region": "eu",
      "Season": "2017-pre4",
      "Match": "solo",
      "Stats": [
        {
          "label": "K/D Ratio",
          "field": "KillDeathRatio",
          "category": "Performance",
          "ValueInt": null,
          "ValueDec": 0.0,
          "value": "0",
          "rank": null,
          "percentile": 100.0,
          "displayValue": "0.00"
        },
        ...
      ]
    },
    ...
  ],
  "MatchHistory": [
    {
      "Id": 11166555,
      "Updated": "2017-09-05T17:41:09.65",
      "UpdatedJS": "1504633269650",
      "Season": 4,
      "SeasonDisplay": "Early Access Season #4",
      "Match": 2,
      "MatchDisplay": "Duo",
      "Region": 2,
      "RegionDisplay": "[EU] Europe",
      "Rounds": 4,
      "Wins": 0,
      "Kills": 2,
      "Assists": 1,
      "Top10": 2,
      "Rating": 1270.2,
      "RatingChange": 1270.2,
      "RatingRank": 256368,
      "RatingRankChange": 256368,
      "Headshots": 0,
      "Kd": 0.5,
      "Damage": 463,
      "TimeSurvived": 4333.51,
      "WinRating": 1063,
      "WinRank": 240738,
      "WinRatingChange": 1063,
      "WinRatingRankChange": 240738,
      "KillRating": 1035,
      "KillRank": 346508,
      "KillRatingChange": 1035,
      "KillRatingRankChange": 346508,
      "MoveDistance": 12239.68
    }
  ]
}
```

# Support
https://github.com/jmwri/pubg-php/issues
