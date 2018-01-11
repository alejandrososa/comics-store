<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 8/01/18
 * Time: 10:41
 */

namespace App\Common\Domain\Model;

/**
 * Interface EventSourcedAggregateRoot
 * @package App\Common\Domain\Model
 */
interface EventSourcedAggregateRoot
{
    /**
     * @param EventStream $events
     * @return mixed
     */
    public static function reconstitute(EventStream $events);
}