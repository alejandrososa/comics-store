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
    private $userSurname;
    private $userEmail;
    private $userPassword;
    private $userStatus;
    private $created;

    /**
     * UserRegistered constructor.
     * @param UserId $userId
     * @param UserName $userName
     * @param UserSurname $userSurname
     * @param UserEmail $userEmail
     * @param UserPassword $userPassword
     * @param UserStatus $userStatus
     * @param \DateTime $created
     */
    public function  __construct(
        UserId $userId,
        UserName $userName,
        UserSurname $userSurname,
        UserEmail $userEmail,
        UserPassword $userPassword,
        UserStatus $userStatus,
        \DateTime $created
    ) {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->userSurname = $userSurname;
        $this->userEmail = $userEmail;
        $this->userPassword = $userPassword;
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
     * @return UserSurname
     */
    public function userSurname(): UserSurname
    {
        return $this->userSurname;
    }

    /**
     * @return UserEmail
     */
    public function userEmail(): UserEmail
    {
        return $this->userEmail;
    }

    /**
     * @return UserPassword
     */
    public function userPassword(): UserPassword
    {
        return $this->userPassword;
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