<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 26/12/17
 * Time: 22:33
 */

namespace App\Accounts\Domain\Model\User;

/**
 * Class UserEmail
 * @package App\Accounts\Domain\Model\User
 */
class UserEmail
{
    const MIN_LENGTH = 3;
    const MAX_LENGTH = 250;

    private $email;

    /**
     * UserEmail constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setEmail(trim($name));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->email();
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @param $name
     */
    private function setEmail(string $name)
    {
        $this->assertNotEmpty($name);
        $this->assertFitsLength($name);
        $this->email = $name;
    }

    /**
     * @param $name
     */
    private function assertNotEmpty($name)
    {
        if (empty($name)) {
            throw new \DomainException('Empty name');
        }
    }

    /**
     * @param $name
     */
    private function assertFitsLength($name)
    {
        if (strlen($name) < self::MIN_LENGTH) {
            throw new \DomainException('Email is too sort');
        }
        if (strlen($name) > self::MAX_LENGTH) {
            throw new \DomainException('Email is too long');
        }
    }
}