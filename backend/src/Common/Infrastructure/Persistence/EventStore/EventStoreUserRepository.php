<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 8/01/18
 * Time: 12:46
 */

namespace App\Common\Infrastructure\Persistence\EventStore;

use App\Accounts\Domain\Model\User\User;
use App\Accounts\Domain\Model\User\UserEmail;
use App\Accounts\Domain\Model\User\UserId;
use App\Accounts\Domain\Model\User\UserRepository;
use App\Accounts\Infrastructure\Projection\Projector;
use App\Common\Domain\Model\AggregateDoesNotExist;
use App\Common\Domain\Model\EventStore;
use App\Common\Domain\Model\EventStream;

/**
 * Class EventStoreUserRepository
 * @package App\Common\Infrastructure\Persistence\EventStore
 */
class EventStoreUserRepository implements UserRepository
{
    private $eventstore;
    private $projector;

    /**
     * EventStoreUserRepository constructor.
     * @param EventStore $eventstore
     * @param Projector $projector
     */
    public function __construct(EventStore $eventstore, Projector $projector)
    {
        $this->eventstore = $eventstore;
        $this->projector = $projector;
    }

    public function add(User $user)
    {
        $events = $user->recordedEvents();
        $this->eventstore->append(new EventStream($user->id(), $events));
        $user->clearEvents();
        $this->projector->project($events);
    }

    public function findById(UserId $id)
    {
        return User::reconstitute($this->eventstore->getEventsFor($id));
    }

    public function findByEmail(UserEmail $email)
    {
        return User::reconstitute($this->eventstore->getEventsFor($email));
    }

    /**
     * Generates a new UserId
     *
     * @return UserId
     */
    public function nextIdentity()
    {
        return new UserId();
    }

    /**
     * Tells whether a UserId exists or not
     *
     * @param UserId $userId
     *
     * @return boolean
     */
    public function has(UserId $userId)
    {
        try {
            $this->eventstore->getEventsFor($userId);
            return true;
        } catch (AggregateDoesNotExist $e) {
            return false;
        }
    }
}