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
 * Class UserSignInResponse
 * @package App\Accounts\Application\Response\User
 */
class UserSignInResponse
{
    public $id;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $status;

    /**
     * SignUpUserResponse constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->id = $user->id();
        $this->name = $user->name();
        $this->surname = $user->surname();
        $this->email = $user->email();
        $this->password = $user->password();
        $this->status = $user->status();
    }
}