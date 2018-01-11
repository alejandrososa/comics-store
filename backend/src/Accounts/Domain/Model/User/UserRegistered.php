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
class UserRegistered implements DomainEvent
{
    private $userId;
    private $ocurredOn;
    private $userName;
    private $userEmail;
    private $userStatus;
    private $created;

    /**
     * UserRegistered constructor.
     * @param UserId $userId
     * @param UserName $userName
     * @param UserEmail $userEmail
     * @param UserStatus $userStatus
     * @param \DateTime $created
     */
    public function  __construct(
        UserId $userId,
        UserName $userName,
        UserEmail $userEmail,
        UserStatus $userStatus,
        \DateTime $created
    ) {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->userStatus = $userStatus;
        $this->created = $created;
        $this->ocurredOn = new \DateTimeImmutable();
    }

    /**
     * @return \DateTimeImmutable
     */
    public function occurredOn(): \DateTimeImmutable
    {
        return $this->ocurredOn;
    }

    /**
     * @return UserId
     */
    public function userId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return UserName
     */
    public function userName(): UserName
    {
        return $this->userName;
    }

    /**
     * @return UserEmail
     */
    public function userEmail(): UserEmail
    {
        return $this->userEmail;
    }

    /**
     * @return UserStatus
     */
    public function userStatus(): UserStatus
    {
        return $this->userStatus;
    }

    /**
     * @return \DateTime
     */
    public function userCreated(): \DateTime
    {
        return $this->created;
    }
}