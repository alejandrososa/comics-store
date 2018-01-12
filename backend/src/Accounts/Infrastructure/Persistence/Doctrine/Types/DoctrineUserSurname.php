<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 27/12/17
 * Time: 14:56
 */

namespace App\Accounts\Infrastructure\Persistence\Doctrine\Types;

use App\Accounts\Domain\Model\User\UserSurname;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class DoctrineUserSurname
 * @package App\Accounts\Infrastructure\Persistence\Doctrine\Types
 */
class DoctrineUserSurname extends DoctrineEntityString
{
    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->surname();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'UserSurname';
    }

    /**
     * @return string
     */
    protected function getNamespace()
    {
        return UserSurname::class;
    }
}