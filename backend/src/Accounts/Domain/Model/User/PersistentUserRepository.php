<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 26/12/17
 * Time: 22:40
 */

namespace App\Accounts\Domain\Model\User;


/**
 * Interface PersistentUserRepository
 * @package App\Domain\Model\User
 */
interface PersistentUserRepository extends UserRepository
{
    /**
     * @param User $user
     * @return User|object
     */
    public function add(User $user);

    /**
     * @param User $user|object
     */
    public function remove(User $user);
}