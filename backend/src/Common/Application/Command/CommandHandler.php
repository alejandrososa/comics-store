<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 2/01/18
 * Time: 13:49
 */

namespace App\Common\Application\Command;


/**
 * Interface CommandHandler
 * @package App\Application\Command
 */
interface CommandHandler
{
    /**
     * @param Command $command
     * @return mixed
     */
    public function handle(Command $command);
}