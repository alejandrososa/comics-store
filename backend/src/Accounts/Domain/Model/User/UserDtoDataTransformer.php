<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 28/12/17
 * Time: 11:56
 */

namespace App\Accounts\Domain\Model\User;

/**
 * Class UserDtoDataTransformer
 * @package App\Accounts\Domain\Model\User
 */
class UserDtoDataTransformer implements UserDataTransformer
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     * @return mixed
     */
    public function write(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function read()
    {
        return [
            'id' => $this->user->id()->id(),
            'name' => $this->user->name()->name(),
        ];
    }
}