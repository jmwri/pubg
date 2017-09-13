<?php

namespace JmWri\Pubg\Test\Output;

use JmWri\Pubg\Output\Account;
use JmWri\Pubg\Test\BaseTest;
use JmWri\Pubg\Test\DataFactory;

/**
 * Class AccountTest
 * @package JmWri\Pubg\Test\Output
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class AccountTest extends BaseTest
{
    /**
     * @var Account
     */
    protected $account;

    public function setUp()
    {
        $dataFactory = new DataFactory();
        $data = $dataFactory->getTestData(Account::class);
        $this->account = new Account($data);
    }

    public function testDataIsSet()
    {
        $this->assertEquals('test_account_id', $this->account->getAccountId());
        $this->assertEquals('test_nickname', $this->account->getNickname());
        $this->assertEquals('test_avatar_url', $this->account->getAvatarUrl());
        $this->assertEquals(1234, $this->account->getSteamId());
        $this->assertEquals('test_steam_name', $this->account->getSteamName());
        $this->assertEquals('test_state', $this->account->getState());
        $this->assertTrue($this->account->getInviteAllow());
    }
}
