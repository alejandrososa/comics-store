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
class UserRegisterCommand implements Command
{
    private $name;
    private $email;

    /**
     * UserRegisterCommand constructor.
     * @param $name
     * @param $email
     */
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
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
    public function getEmail()
    {
        return $this->email;
    }
}