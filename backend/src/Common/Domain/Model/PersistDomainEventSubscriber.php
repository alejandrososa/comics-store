<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 8/01/18
 * Time: 11:43
 */

namespace App\Common\Domain\Model;

use App\Common\Domain\Model\Event\PublishableDomainEvent;

/**
 * Class PersistDomainEventSubscriber
 * @package App\Common\Domain\Model
 */
class PersistDomainEventSubscriber implements DomainEventSubscriber
{
    /**
     * @var EventStore
     */
    private $eventStore;

    /**
     * PersistDomainEventSubscriber constructor.
     * @param $anEventStore
     */
    public function __construct($anEventStore)
    {
        $this->eventStore = $anEventStore;
    }

    /**
     * @param DomainEvent $aDomainEvent
     */
    public function handle(DomainEvent $aDomainEvent)
    {
        $this->eventStore->append($aDomainEvent);
    }

    /**
     * @param DomainEvent $aDomainEvent
     * @return bool
     */
    public function isSubscribedTo(DomainEvent $aDomainEvent)
    {
        return $aDomainEvent instanceof PublishableDomainEvent;
    }
}

https://github.com/prooph/event-sourcing/blob/master/examples/quickstart.php