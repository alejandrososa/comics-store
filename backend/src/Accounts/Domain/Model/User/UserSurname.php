<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 26/12/17
 * Time: 22:33
 */

namespace App\Accounts\Domain\Model\User;

/**
 * Class UserSurname
 * @package App\Accounts\Domain\Model\User
 */
class UserSurname
{
    const MIN_LENGTH = 3;
    const MAX_LENGTH = 250;

    /**
     * @var string
     */
    private $surname;

    /**
     * UserName constructor.
     * @param $surname
     */
    public function __construct(string $surname)
    {
        $this->setSurname(trim($surname));
    }

    /**
     * @return string
     */
    public function surname()
    {
        return $this->surname;
    }

    /**
     * @param $surname
     */
    private function setSurname(string $surname)
    {
        $this->assertNotEmpty($surname);
        $this->assertFitsLength($surname);
        $this->surname = $surname;
    }

    /**
     * @param $surname
     */
    private function assertNotEmpty($surname)
    {
        if (empty($surname)) {
            throw new \DomainException('Empty user surname');
        }
    }

    /**
     * @param $surname
     */
    private function assertFitsLength($surname)
    {
        if (strlen($surname) < self::MIN_LENGTH) {
            throw new \DomainException('User surname is too sort');
        }
        if (strlen($surname) > self::MAX_LENGTH) {
            throw new \DomainException('User surname is too long');
        }
    }
}