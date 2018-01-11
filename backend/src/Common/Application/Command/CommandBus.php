<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 2/01/18
 * Time: 13:48
 */

namespace App\Common\Application\Command;

/**
 * Interface CommandBus
 * @package App\Common\Application\Command
 */
interface CommandBus
{
    public function execute(Command $command);
}