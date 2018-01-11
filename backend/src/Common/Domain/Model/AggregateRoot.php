<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 5/01/18
 * Time: 11:31
 */

namespace App\Common\Domain\Model;

/**
 * Class AggregateRoot
 * @package App\Common\Domain\Model\Event
 */
class AggregateRoot
{
    private $recordedEvents = [];

    /**
     * @param DomainEvent $domainEvent
     */
    protected function recordApplyAndPublishThat(DomainEvent $domainEvent)
    {
        $this->recordThat($domainEvent);
        $this->applyThat($domainEvent);
        $this->publishThat($domainEvent);
    }

    /**
     * @param DomainEvent $domainEvent
     */
    protected function recordThat(DomainEvent $domainEvent)
    {
        $this->recordedEvents[] = $domainEvent;
    }

    /**
     * @param DomainEvent $domainEvent
     */
    protected function applyThat(DomainEvent $domainEvent)
    {
       $modifier = 'apply' . array_reverse(explode('\\', get_class($domainEvent)))[0];
        if (!method_exists($this, $modifier)) {
            return;
        }
        $this->$modifier($domainEvent);
    }

    /**
     * @param DomainEvent $domainEvent
     */
    protected function publishThat(DomainEvent $domainEvent)
    {
        DomainEventPublisher::instance()->publish($domainEvent);
    }

    public function recordedEvents()
    {
        return $this->recordedEvents;
    }

    public function clearEvents()
    {
        $this->recordedEvents = [];
    }
}