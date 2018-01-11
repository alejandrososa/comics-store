<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 8/01/18
 * Time: 10:54
 */

namespace App\Common\Domain\Model;

/**
 * Interface EventStore
 * @package App\Common\Domain\Model
 */
interface EventStore
{
    /**
     * @param EventStream $events
     * @return mixed
     */
    public function append(EventStream $events);

    /**
     * @param $id
     * @return EventStream[]
     */
    public function getEventsFor($id);
}