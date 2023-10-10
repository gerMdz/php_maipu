<?php

namespace App\Controller;

use App\Service\DefaultService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    private DefaultService $defaultService;

    /**
     * @param DefaultService $defaultService
     */
    public function __construct(DefaultService $defaultService)
    {
        $this->defaultService = $defaultService;
    }

    #[Route(path: '/articulos', name: 'articles', methods: ['GET'])]
    public function list(Request $request): Response
    {
        $data = $request->query->get('nombre' , 'Gerardo');

        $a = 30;
        $b = 15;

        $a += $b;

        return new Response('Bienvenido a PHP Maipú: ' . $data. ',  <br/>'
            . $this->defaultService->obtenerVersionPhp() . ', <br/>'
            . $this->defaultService->obtenerSO(). ', <br/>'
            . $this->defaultService->obtenerPathExtensionPhp(). ', <br/>'
            .' y ' . $this->defaultService->obtenerPi() . ', <br/>'
            . 'viendo los datos de $a '. $a

        )
            ;
    }

    #[Route(path: '/articulos-json', name: 'articles-json', methods: ['GET'])]
    public function listJson(Request $request)
    {

        return new JsonResponse(['nombre' => 'Gerardo'], Response::HTTP_CREATED);
    }
}
