<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 27/12/17
 * Time: 14:56
 */

namespace App\Accounts\Infrastructure\Persistence\Doctrine\Types;

use App\Accounts\Domain\Model\User\UserId;

/**
 * Class DoctrineUserId
 * @package App\Accounts\Infrastructure\Persistence\Doctrine\Types
 */
class DoctrineUserId extends DoctrineEntityId
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'UserId';
    }

    /**
     * @return string
     */
    protected function getNamespace()
    {
        return UserId::class;
    }
}