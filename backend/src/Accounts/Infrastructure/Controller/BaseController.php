<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 5/01/18
 * Time: 16:15
 */

namespace App\Accounts\Infrastructure\Controller;

use App\Common\Infrastructure\Services\EventStore;
use Doctrine\ORM\EntityManagerInterface;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BaseController
 * @package App\Accounts\Infrastructure\Controller
 */
abstract class BaseController extends Controller
{
    protected $commandBus;

    /**
     * UserController constructor.
     * @param CommandBus $commandBus
     * @param EntityManagerInterface $em
     */
    public function __construct(CommandBus $commandBus, EntityManagerInterface $em)
    {
        $commandBus = new CommandBus([
            new EventStore($em)
        ]);
        $this->commandBus = $commandBus;
    }
}