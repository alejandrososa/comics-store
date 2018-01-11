<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 26/12/17
 * Time: 22:38
 */

namespace App\Accounts\Domain\ReadModel\User;

use App\Accounts\Domain\Model\User\User;

/**
 * Interface CollectionUserRepository
 * @package App\Domain\Model\User
 */
interface CollectionUserRepository extends UserRepository
{
    /**
     * @param User $user
     * @return mixed
     */
    public function add(User $user);
}