<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 5/01/18
 * Time: 11:03
 */

namespace App\Accounts\Domain\Model\User;

use App\Common\Domain\Model\DomainEvent;

/**
 * Class UserRegistered
 * @package App\Accounts\Domain\Model\User
 */
class UserStatusChanged implements DomainEvent
{
    private $userId;
    private $occurredOn;
    private $userStatus;

    /**
     * UserRegistered constructor.
     * @param UserId $userId
     * @param UserStatus $userStatus
     */
    public function __construct(UserId $userId, UserStatus $userStatus)
    {
        $this->userId = $userId;
        $this->userStatus = $userStatus;
        $this->occurredOn = new \DateTimeImmutable();
    }

    /**
     * @return UserStatus
     */
    public function getUserStatus(): UserStatus
    {
        return $this->userStatus;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}