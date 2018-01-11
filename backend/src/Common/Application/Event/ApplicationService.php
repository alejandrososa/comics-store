<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 5/01/18
 * Time: 11:11
 */

namespace App\Common\Application\Event;

/**
 * Interface ApplicationService
 * @package App\Common\Application
 */
interface ApplicationService
{
    /**
     * @param $request
     * @return mixed
     */
    public function execute($request = null);
}