<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 27/12/17
 * Time: 17:44
 */

namespace App\Accounts\Application\Response\User;

use App\Accounts\Domain\Model\User\User;

/**
 * Class UserSignUpResponse
 * @package App\Accounts\Application\Response\User
 */
class UserSignUpResponse
{
    public $id;
    public $name;
    public $email;
    public $status;

    /**
     * SignUpUserResponse constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->id = $user->id();
        $this->email = $user->email();
        $this->name = $user->name();
        $this->status = $user->status();
    }
}