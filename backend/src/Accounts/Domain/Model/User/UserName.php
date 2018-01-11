<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 26/12/17
 * Time: 22:33
 */

namespace App\Accounts\Domain\Model\User;

/**
 * Class UserName
 * @package App\Accounts\Domain\Model\User
 */
class UserName
{
    const MIN_LENGTH = 3;
    const MAX_LENGTH = 250;

    /**
     * @var string
     */
    private $name;

    /**
     * UserName constructor.
     * @param $name
     */
    public function __construct(string $name)
    {
        $this->setName(trim($name));
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    private function setName(string $name)
    {
        $this->assertNotEmpty($name);
        $this->assertFitsLength($name);
        $this->name = $name;
    }

    /**
     * @param $name
     */
    private function assertNotEmpty($name)
    {
        if (empty($name)) {
            throw new \DomainException('Empty user name');
        }
    }

    /**
     * @param $name
     */
    private function assertFitsLength($name)
    {
        if (strlen($name) < self::MIN_LENGTH) {
            throw new \DomainException('User name is too sort');
        }
        if (strlen($name) > self::MAX_LENGTH) {
            throw new \DomainException('User name is too long');
        }
    }
}