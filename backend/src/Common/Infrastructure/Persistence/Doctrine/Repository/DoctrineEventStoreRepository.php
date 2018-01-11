<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 27/12/17
 * Time: 14:49
 */

//http://blog.webdevilopers.net/domain-driven-design-repositories-with-doctrine-orm-and-odm-in-symfony/

namespace App\Common\Infrastructure\Persistence\Doctrine\Repository;

use App\Common\Domain\Model\DomainEvent;
use App\Common\Domain\Model\Event\StoredEvent;
use App\Common\Domain\Model\EventStore;
use App\Common\Domain\Model\EventStream;
use Doctrine\ORM\EntityRepository;
use JMS\Serializer\SerializerBuilder;

/**
 * Class DoctrineUserRepository
 * @package App\Infrastructure\Persistence\Doctrine\Repository
 */
class DoctrineEventStoreRepository extends EntityRepository implements EventStore
{
    private $serializer;

    /**
     * @param EventStream $events
     * @return mixed|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function append(EventStream $events)
    {
        foreach ($events as $aDomainEvent) {
            $storedEvent = new StoredEvent(
                get_class($aDomainEvent),
                $aDomainEvent->occurredOn(),
                $this->serializer()->serialize($aDomainEvent, 'json')
            );
            $this->getEntityManager()->persist($storedEvent);
            $this->getEntityManager()->flush($storedEvent);
        }
    }

    /**
     * @param $anEventId
     * @return DomainEvent[]
     */
    public function getEventsFor($anEventId)
    {
        $query = $this->createQueryBuilder('e');
        if ($anEventId) {
            $query->where('e.eventId > :eventId');
            $query->setParameters(array('eventId' => $anEventId));
        }
        $query->orderBy('e.eventId');
        return $query->getQuery()->getResult();
    }

    /**
     * @return \JMS\Serializer\Serializer
     */
    private function serializer()
    {
        if (null === $this->serializer) {
            $this->serializer = SerializerBuilder::create()->build();
        }
        return $this->serializer;
    }
}