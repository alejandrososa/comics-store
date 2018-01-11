<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 8/01/18
 * Time: 16:05
 */

namespace App\Accounts\Infrastructure\Projection\Elasticsearch\User;

use App\Accounts\Domain\Model\User\UserRegistered;
use App\Accounts\Infrastructure\Projection\Projection;
use Elastica\Client;

/**
 * Class PostRegisteredProjection
 * @package App\Accounts\Infrastructure\Projection\Elasticsearch\User
 */
class PostRegisteredProjection implements Projection
{
    private $client;

    /**
     * PostRegisteredProjection constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function eventType()
    {
        return UserRegistered::class;
    }

    public function project($event)
    {
        /** @var UserRegistered $event */
        $this->client->index([
            'index' => 'users',
            'type' => 'user',
            'id' => $event->userId(),
            'body' => [
                'name' => $event->userName(),
                'email' => $event->userEmail(),
                'status' => $event->userStatus(),
            ]
        ]);
    }
}