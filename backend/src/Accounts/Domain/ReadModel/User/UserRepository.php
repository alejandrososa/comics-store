<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 26/12/17
 * Time: 22:14
 */

namespace App\Accounts\Domain\ReadModel\User;

use App\Accounts\Domain\Model\User\User;
use App\Accounts\Domain\Model\User\UserEmail;
use App\Accounts\Domain\Model\User\UserId;

/**
 * Interface UserRepository
 * @package App\Accounts\Domain\ReadModel\User
 */
interface UserRepository
{
    /**
     * @param UserId $userId
     * @return User
     */
    public function findById(UserId $userId);

    /**
     * @param UserEmail $email
     *
     * @return User
     */
    public function findByEmail(UserEmail $email);

    /**
     * @return User[]
     */
    public function findAll();

    /**
     * @param User $user
     */
    public function add(User $user);

    /**
     * @return UserId
     */
    public function nextIdentity();
}