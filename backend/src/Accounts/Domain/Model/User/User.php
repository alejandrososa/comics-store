<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 26/12/17
 * Time: 16:03
 */

namespace App\Accounts\Domain\Model\User;

use App\Common\Domain\Model\AggregateRoot;
use App\Common\Domain\Model\EventSourcedAggregateRoot;
use App\Common\Domain\Model\EventStream;
use function Assert\thatAll;

/**
 * Class User
 * @package App\Accounts\Domain\Model\User
 */
class User extends AggregateRoot implements EventSourcedAggregateRoot
{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $status;
    /**
     * @var UserPassword
     */
    private $password;
    private $created;
    private $updated;

    /**
     * User constructor.
     * @param UserId $id
     */
    private function __construct(UserId $id)
    {
        $this->id = $id;

    }

    /**
     * Create user from parameters
     * @param UserName $name
     * @param UserEmail $email
     * @param UserStatus $status
     * @return User
     */
    public static function createNewFrom(
        UserName $name,
        UserSurname $surname,
        UserEmail $email,
        UserPassword $password,
        UserStatus $status
    ){
        $userId = UserId::create();
        $user = new static($userId);
        $date = new \DateTime();

        $user->recordApplyAndPublishThat(
            new UserRegistered($userId, $name, $surname, $email, $password, $status, $date)
        );

        return $user;
    }

    /**
     * @return UserId
     */
    public function id(): UserId
    {
        return $this->id;
    }

    /**
     * @return UserName
     */
    public function name(): UserName
    {
        return $this->name;
    }

    /**
     * @return UserSurname
     */
    public function surname(): UserSurname
    {
        return $this->surname;
    }

    /**
     * @return UserEmail
     */
    public function email(): UserEmail
    {
        return $this->email;
    }

    /**
     * @return UserPassword
     */
    public function password(): UserPassword
    {
        return $this->password;
    }

    /**
     * @return UserStatus
     */
    public function status(): UserStatus
    {
        return $this->status;
    }

    /**
     * @return \DateTime
     */
    public function created(): \DateTime
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function updated(): \DateTime
    {
        return $this->updated;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password()->password());
    }

    protected function changeStatus(UserStatus $userStatus)
    {
        $this->recordApplyAndPublishThat(
            new UserStatusChanged($this->id, $userStatus)
        );
    }

    protected function applyUserRegistered(UserRegistered $event)
    {
        $this->id = $event->userId();
        $this->name = $event->userName();
        $this->surname = $event->userSurname();
        $this->email = $event->userEmail();
        $this->password = $event->userPassword();
        $this->status = $event->userStatus();
        $this->created = $event->userCreated();
    }

    /**
     * @param EventStream $events
     * @return mixed
     */
    public static function reconstitute(EventStream $events)
    {
        $user = new static($events->aggregateId());
        foreach ($events as $event) {
            $user->applyThat($event);
        }
        return $user;
    }
}