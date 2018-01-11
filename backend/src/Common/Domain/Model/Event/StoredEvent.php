<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 8/01/18
 * Time: 11:47
 */

namespace App\Common\Domain\Model\Event;

use App\Common\Domain\Model\DomainEvent;

/**
 * Class StoredEvent
 * @package App\Common\Domain\Model\Event
 */
class StoredEvent implements DomainEvent
{
    /**
     * @var int
     */
    private $eventId;

    /**
     * @var string
     */
    private $eventBody;

    /**
     * @var \DateTimeImmutable
     */
    private $occurredOn;

    /**
     * @var string
     */
    private $typeName;

    /**
     * @param string $aTypeName
     * @param \DateTimeImmutable $anOccurredOn
     * @param string $anEventBody
     */
    public function __construct($aTypeName, \DateTimeImmutable $anOccurredOn, $anEventBody)
    {
        $this->eventBody = $anEventBody;
        $this->typeName = $aTypeName;
        $this->occurredOn = $anOccurredOn;
    }

    /**
     * @return string
     */
    public function eventBody()
    {
        return $this->eventBody;
    }

    /**
     * @return int
     */
    public function eventId()
    {
        return $this->eventId;
    }

    /**
     * @return string
     */
    public function typeName()
    {
        return $this->typeName;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}