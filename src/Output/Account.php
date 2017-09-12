<?php

namespace JmWri\Pubg\Output;

/**
 * Class Account
 * @package JmWri\Pubg\Output
 */
class Account
{
    /**
     * @var []
     */
    protected $data;

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
     * @var int
     */
    protected $steamId;

    /**
     * @var string
     */
    protected $steamName;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var bool
     */
    protected $inviteAllow;

    /**
     * Account constructor.
     *
     * @param [] $data
     */
    public function __construct($data)
    {
        $this->setData($data);
        $this->setAccountId($this->data['AccountId']);
        $this->setNickname($this->data['Nickname']);
        $this->setAvatarUrl($this->data['AvatarUrl']);
        $this->setSteamId($this->data['SteamId']);
        $this->setSteamName($this->data['SteamName']);
        $this->setState($this->data['State']);
        $this->setInviteAllow($this->data['InviteAllow']);
    }

    /**
     * @param [] $data
     */
    protected function setData($data)
    {
        $this->data = $data;
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
     * @return int
     */
    public function getSteamId()
    {
        return $this->steamId;
    }

    /**
     * @param int $steamId
     */
    protected function setSteamId($steamId)
    {
        $this->steamId = (int)$steamId;
    }

    /**
     * @return string
     */
    public function getSteamName()
    {
        return $this->steamName;
    }

    /**
     * @param string $steamName
     */
    protected function setSteamName($steamName)
    {
        $this->steamName = $steamName;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    protected function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return bool
     */
    public function getInviteAllow()
    {
        if (!is_bool($this->inviteAllow)) {
            return false;
        }
        return $this->inviteAllow;
    }

    /**
     * @param bool $inviteAllow
     */
    protected function setInviteAllow($inviteAllow)
    {
        $this->inviteAllow = $inviteAllow;
    }
}
