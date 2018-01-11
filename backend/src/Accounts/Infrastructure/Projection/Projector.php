<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 8/01/18
 * Time: 11:14
 */

namespace App\Accounts\Infrastructure\Projection;

/**
 * Class Projector
 * @package App\Accounts\Infrastructure\Projection
 */
class Projector
{
    /**
     * @var array
     */
    private $projections = [];

    /**
     * @param array $projections
     */
    public function register(array $projections)
    {
        foreach ($projections as $projection) {
            $this->projections[$projection->eventType()] = $projection;
        }
    }

    /**
     * @param array $events
     */
    public function project(array $events)
    {
        foreach ($events as $event) {
            if (isset($this->projections[get_class($event)])) {
                $this->projections[get_class($event)]->project($event);
            }
        }
    }
}