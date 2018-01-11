<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 27/12/17
 * Time: 14:56
 */

namespace App\Accounts\Infrastructure\Persistence\Doctrine\Types;

use App\Accounts\Domain\Model\User\UserStatus;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class DoctrineUserStatus
 * @package App\Accounts\Infrastructure\Persistence\Doctrine\Types
 */
class DoctrineUserStatus extends DoctrineEntityInteger
{
    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->status();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'UserStatus';
    }

    /**
     * @return string
     */
    protected function getNamespace()
    {
        return UserStatus::class;
    }
}