<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 27/12/17
 * Time: 14:56
 */

namespace App\Accounts\Infrastructure\Persistence\Doctrine\Types;

use App\Accounts\Domain\Model\User\UserPassword;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class DoctrineUserPassword
 * @package App\Accounts\Infrastructure\Persistence\Doctrine\Types
 */
class DoctrineUserPassword extends DoctrineEntityString
{
    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->password();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'UserPassword';
    }

    /**
     * @return string
     */
    protected function getNamespace()
    {
        return UserPassword::class;
    }
}