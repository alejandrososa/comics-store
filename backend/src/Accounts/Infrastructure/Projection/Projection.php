<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 8/01/18
 * Time: 11:13
 */

namespace App\Accounts\Infrastructure\Projection;

/**
 * Interface Projection
 * @package App\Accounts\Infrastructure\Projection
 */
interface Projection
{
    public function eventType();
    public function project($event);
}