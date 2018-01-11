<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 27/12/17
 * Time: 14:56
 */

namespace App\Accounts\Infrastructure\Persistence\Doctrine\Types;

use App\Accounts\Domain\Model\User\UserName;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class DoctrineUserName
 * @package App\Accounts\Infrastructure\Persistence\Doctrine\Types
 */
class DoctrineUserName extends DoctrineEntityString
{
    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->name();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'UserName';
    }

    /**
     * @return string
     */
    protected function getNamespace()
    {
        return UserName::class;
    }
}