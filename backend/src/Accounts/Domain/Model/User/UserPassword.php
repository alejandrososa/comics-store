<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 26/12/17
 * Time: 22:33
 */

namespace App\Accounts\Domain\Model\User;

/**
 * Class UserPassword
 * @package App\Accounts\Domain\Model\User
 */
class UserPassword
{
    const MIN_LENGTH = 3;
    const MAX_LENGTH = 250;

    /**
     * @var string
     */
    private $password;

    /**
     * UserName constructor.
     * @param $password
     */
    public function __construct(string $password)
    {
        $this->setPassword(trim($password));
    }

    /**
     * @return string
     */
    public function password()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return UserPassword
     */
    public static function encryptFrom(string $password): self
    {
        $userPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

        return new self($userPassword);
    }

    /**
     * @param UserPassword $password
     * @return bool
     */
    public function equalTo(UserPassword $password): bool
    {
        $this->assertNotEmpty($password);

        return password_verify($password->password(), $this->password);
    }

    /**
     * @param $password
     */
    private function setPassword(string $password)
    {
        $this->assertNotEmpty($password);
        $this->assertFitsLength($password);
        $this->password = $password;
    }

    /**
     * @param $password
     */
    private function assertNotEmpty($password)
    {
        if (empty($password)) {
            throw new \DomainException('Empty user password');
        }
    }

    /**
     * @param $password
     */
    private function assertFitsLength($password)
    {
        if (strlen($password) < self::MIN_LENGTH) {
            throw new \DomainException('User password is too sort');
        }
        if (strlen($password) > self::MAX_LENGTH) {
            throw new \DomainException('User password is too long');
        }
    }
}