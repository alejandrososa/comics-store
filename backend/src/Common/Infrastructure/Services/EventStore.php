<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 9/01/18
 * Time: 12:21
 */

namespace App\Common\Infrastructure\Services;

use App\Common\Domain\Model\DomainEventPublisher;
use App\Common\Domain\Model\PersistDomainEventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use League\Tactician\Middleware;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class EventStore
 * @package App\Common\Infrastructure\Services
 */
class EventStore implements Middleware
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $eventStore = $this->em->getRepository('Common:Event\StoredEvent');

        DomainEventPublisher::instance()->subscribe(
            new PersistDomainEventSubscriber($eventStore)
        );
    }

    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $eventStore = $this->em->getRepository('Common:Event\StoredEvent');

        DomainEventPublisher::instance()->subscribe(
            new PersistDomainEventSubscriber($eventStore)
        );
    }
}