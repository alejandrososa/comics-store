<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 5/01/18
 * Time: 11:04
 */

namespace App\Common\Domain\Model;
/**
 * Interface DomainEvent
 * @package App\Common\Domain\Model
 */
interface DomainEvent
{
    /**
     * @return \DateTimeImmutable
     */
    public function occurredOn(): \DateTimeImmutable;
}