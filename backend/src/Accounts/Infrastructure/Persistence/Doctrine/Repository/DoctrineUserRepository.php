<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 27/12/17
 * Time: 14:49
 */

//http://blog.webdevilopers.net/domain-driven-design-repositories-with-doctrine-orm-and-odm-in-symfony/

namespace App\Accounts\Infrastructure\Persistence\Doctrine\Repository;

use App\Accounts\Domain\Model\User\PersistentUserRepository;
use App\Accounts\Domain\Model\User\User;
use App\Accounts\Domain\Model\User\UserEmail;
use App\Accounts\Domain\Model\User\UserId;
use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineUserRepository
 * @package App\Infrastructure\Persistence\Doctrine\Repository
 */
class DoctrineUserRepository extends EntityRepository implements PersistentUserRepository
{
    /**
     * @param UserId $userId
     * @return User|object
     */
    public function findById(UserId $userId)
    {
        return $this->findOneBy(['id'=>$userId]);
    }

    /**
     * @param UserEmail $email
     *
     * @return User|object
     */
    public function findByEmail(UserEmail $email)
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @param User $user
     * @return User
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(User $user)
    {
        $events = $user->recordedEvents();

        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush($user);

        return $user;
    }

    /**
     * @param User $user
     * @throws \Doctrine\ORM\ORMException
     */
    public function remove(User $user)
    {
        $this->getEntityManager()->remove($user);
    }

    /**
     * @return UserId
     */
    public function nextIdentity()
    {
        return new UserId();
    }
}