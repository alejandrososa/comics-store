<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 27/12/17
 * Time: 14:52
 */

namespace App\Accounts\Infrastructure\Persistence\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

/**
 * Class DoctrineEntityInteger
 * @package App\Accounts\Infrastructure\Persistence\Doctrine\Types
 */
class DoctrineEntityInteger extends IntegerType
{
    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $className = $this->getNamespace();
        return new $className($value);
    }
}