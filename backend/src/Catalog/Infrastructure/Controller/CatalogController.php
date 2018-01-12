<?php
/**
 * Created by PhpStorm.
 * User: grace
 * Date: 25/12/17
 * Time: 14:51
 */

namespace App\Catalog\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CatalogController
 * @package App\Catalog\Infrastructure\Controller
 */
class CatalogController extends BaseController
{
    public function getSearch(Request $request): JsonResponse
    {
        $heroes = ['id' => 11, 'name' => 'Mr. Nice'];
        return $this->json($heroes);
    }

    public function allHeroes(Request $request): JsonResponse
    {
        $heroes = [
            ['id' => 11, 'name' => 'Mr. Nice'],
            ['id' => 12, 'name' => 'Narco'],
            ['id' => 13, 'name' => 'Bombasto'],
            ['id' => 14, 'name' => 'Celeritas'],
            ['id' => 15, 'name' => 'Magneta'],
            ['id' => 16, 'name' => 'RubberMan'],
            ['id' => 17, 'name' => 'Dynama'],
            ['id' => 18, 'name' => 'Dr IQ'],
            ['id' => 19, 'name' => 'Magma'],
            ['id' => 20, 'name' => 'Tornado']
        ];
        return $this->json($heroes);
    }

    public function getHeroe(Request $request): JsonResponse
    {
        $heroes = ['id' => 11, 'name' => 'Mr. Nice'];
        return $this->json($heroes);
    }

    public function postHeroe(Request $request): JsonResponse
    {
        $heroes = ['id' => 11, 'name' => 'Mr. Nice'];
        return $this->json($heroes);
    }

    public function putHeroe(Request $request): JsonResponse
    {
        $heroes = ['id' => 11, 'name' => 'Mr. Nice'];
        return $this->json($heroes);
    }
}