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
 * Class UserRegisterCommand
 * @package App\Accounts\Application\Command\User
 */
class UserSignUpCommand implements Command
{
    private $name;
    private $surname;
    private $email;
    private $password;

    /**
     * UserRegisterCommand constructor.
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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
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