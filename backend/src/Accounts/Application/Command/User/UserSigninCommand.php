<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 2/01/18
 * Time: 13:07
 */

namespace App\Accounts\Application\Command\User;

use App\Common\Application\Command\Command;

/**
 * Class UserLoginCommand
 * @package App\Accounts\Application\Command\User
 */
class UserSigninCommand implements Command
{
    private $email;
    private $password;

    /**
     * UserRegisterCommand constructor.
     * @param $email
     * @param $password
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}