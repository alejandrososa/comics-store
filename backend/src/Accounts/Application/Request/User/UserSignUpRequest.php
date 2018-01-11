<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 5/01/18
 * Time: 12:06
 */

namespace App\Accounts\Application\Request\User;

/**
 * Class UserSignUpRequest
 * @package App\Accounts\Application\Request\User
 */
class UserSignUpRequest
{
    public $name;
    public $email;

    /**
     * SignUpUserRequest constructor.
     * @param $name
     * @param $email
     */
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}