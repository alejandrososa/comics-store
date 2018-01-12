<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 5/01/18
 * Time: 12:06
 */

namespace App\Accounts\Application\Request\User;

/**
 * Class UserSignInRequest
 * @package App\Accounts\Application\Request\User
 */
class UserSignInRequest
{
    public $email;
    public $password;

    /**
     * UserSignInRequest constructor.
     * @param $email
     * @param $password
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}