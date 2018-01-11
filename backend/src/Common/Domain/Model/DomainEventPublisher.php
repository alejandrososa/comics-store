<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 8/01/18
 * Time: 11:41
 */

namespace App\Common\Domain\Model;

/**
 * Class DomainEventPublisher
 * @package App\Common\Domain\Model
 */
class DomainEventPublisher
{
    /**
     * @var DomainEventSubscriber[]
     */
    private $subscribers;
    /**
     * @var DomainEventPublisher
     */
    private static $instance = null;
    private $id = 0;

    /**
     * DomainEventPublisher constructor.
     */
    private function __construct()
    {
        $this->subscribers = [];
    }

    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new self();
        }
        return static::$instance;
    }

    public function __clone()
    {
        throw new \BadMethodCallException('Clone is not supported');
    }

    /**
     * @param $aDomainEventSubscriber
     * @return int
     */
    public function subscribe($aDomainEventSubscriber)
    {
        $id = $this->id;
        $this->subscribers[$id] = $aDomainEventSubscriber;
        $this->id++;
        return $id;
    }

    /**
     * @param $id
     * @return DomainEventSubscriber|mixed|null
     */
    public function ofId($id)
    {
        return isset($this->subscribers[$id]) ? $this->subscribers[$id] : null;
    }

    /**
     * @param $id
     */
    public function unsubscribe($id)
    {
        unset($this->subscribers[$id]);
    }

    /**
     * @param DomainEvent $aDomainEvent
     */
    public function publish(DomainEvent $aDomainEvent)
    {
        foreach ($this->subscribers as $aSubscriber) {
            if ($aSubscriber->isSubscribedTo($aDomainEvent)) {
                $aSubscriber->handle($aDomainEvent);
            }
        }
    }
}