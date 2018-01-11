<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 26/12/17
 * Time: 22:14
 */

namespace App\Accounts\Domain\Model\User;

/**
 * Interface UserRepository
 * @package App\Accounts\Domain\Model\User
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
     * @param User $user
     */
    public function add(User $user);

    /**
     * @return UserId
     */
    public function nextIdentity();
}