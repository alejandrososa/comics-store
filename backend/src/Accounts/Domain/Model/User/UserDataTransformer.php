<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 28/12/17
 * Time: 11:55
 */

namespace App\Accounts\Domain\Model\User;

/**
 * Interface UserDataTransformer
 * @package App\Accounts\Domain\Model\User
 */
interface UserDataTransformer
{
    /**
     * @param User $user
     * @return mixed
     */
    public function write(User $user);

    /**
     * @return mixed
     */
    public function read();
}