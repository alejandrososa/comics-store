<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 8/01/18
 * Time: 10:53
 */

namespace App\Common\Domain\Model;

/**
 * Class AggregateDoesNotExist
 * @package App\Common\Domain\Model\Event
 */
class AggregateDoesNotExist extends \RuntimeException
{
    /**
     * AggregateDoesNotExist constructor.
     * @param $aggregateId
     */
    public function __construct($aggregateId)
    {
        parent::__construct(sprintf('Aggregate with ID of "%s" does not exist!', $aggregateId));
    }
}