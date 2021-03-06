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
    public $surname;
    public $password;

    /**
     * SignUpUserRequest constructor.
     * @param $name
     * @param $surname
     * @param $email
     * @param $password
     */
    public function __construct($name, $surname, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->surname = $surname;
        $this->password = $password;
    }
}