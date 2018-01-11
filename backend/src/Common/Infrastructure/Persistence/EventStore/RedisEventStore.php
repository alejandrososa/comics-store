<?php

namespace App\Common\Infrastructure\Persistence\EventStore;

use App\Common\Domain\Model\AggregateDoesNotExist;
use App\Common\Domain\Model\EventStore;
use App\Common\Domain\Model\EventStream;
use DateTimeImmutable;
use DateTimeZone;
use JMS\Serializer\Serializer;
use Predis\Client;

class RedisEventStore implements EventStore
{
    /**
     * @var Client
     */
    private $predis;

    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(Client $predis, Serializer $serializer)
    {
        $this->predis = $predis;
        $this->serializer = $serializer;
    }

    public function append(EventStream $events)
    {
        foreach ($events as $event) {
            $data = $this->serializer->serialize($event, 'json');

            $event = $this->serializer->serialize([
                'type' => get_class($event),
                'created_on' => (new DateTimeImmutable('now', new DateTimeZone('UTC')))->getTimestamp(),
                'data' => $data
            ], 'json');

            $this->predis->rpush('events:' . $events->aggregateId(), $event);
            $this->predis->rpush('published_events', $event);
        }
    }

    public function getEventsFor($id)
    {
        if (!$this->predis->exists('events:' . $id)) {
            throw new AggregateDoesNotExist($id);
        }

        $serializedEvents = $this->predis->lrange('events:' . $id, 0, -1);

        $eventStream = [];

        foreach ($serializedEvents as $serializedEvent) {
            $eventData = $this->serializer->deserialize(
                $serializedEvent,
                'array',
                'json'
            );

            $eventStream[] = $this->serializer->deserialize(
                $eventData['data'],
                $eventData['type'],
                'json'
            );
        }

        return new EventStream($id, $eventStream);
    }
}