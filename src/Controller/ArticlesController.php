<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\DefaultService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    const BASE = 1;
    const EXP = 5;

    const DAYS = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
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
        return new Response((string)$this->getPosition('Juan Pablo Muñoz', 5, 'a', 'Pablo'));
    }

    public function getPosition(string $cadena, int $pos, string $letra, string $palabra): string
    {
        // cantidad de bits
        $largo = strlen($cadena);

        // cantidad de caracteres
        $largo_cadena = mb_strlen($cadena);

        // índice de búsqueda
        $position = strpos($cadena, $letra);

        // índice de búsqueda cambiando la dirección
        $position2 = strrpos($cadena, $letra);

        // Si una cadena está dentro de otra
        $match = str_contains($cadena, $palabra);

        // Si una cadena inicia con otra
        $inicia = str_starts_with($cadena, $palabra);

        // Si una cadena termina con otra
        $finaliza = str_ends_with($cadena, $palabra);

        // Compara tamaños de cadenas
        $size = strcmp($cadena, $palabra);
        // Aquí no tiene en cuenta mayúsculas ni minusculas
        // $size = strcasecmp($cadena, $palabra);

        // Subcadena => cadena, inicio, fin (opcional)
        $subcadena = substr($cadena, $pos, $largo_cadena);

        // Subcadena inversa => cadena, inicio, fin (opcional) contando bytes
        $subcadenaI = mb_substr($cadena, -$pos, $largo_cadena);
        // Subcadena inversa => cadena, inicio, fin (opcional) pero contando caracteres
        // $subcadenaI = mb_substr($cadena, -$pos, $largo_cadena);

        // Cambiando un string por otro
        $cadenaR = str_replace($palabra, $letra, $cadena);

        // Cambiando a minúsculas
        $cadenaMin = strtolower($cadena);

        // Cambiando a mayúsculas
        $cadenaMay = mb_strtoupper($cadena);

        // Cambiando a mayúsculas solo la primera letra
        $letraMay = ucfirst($cadena);

        // Cambiando a mayúsculas solo la primera palabra
        $palabraMay = ucwords($cadena);

        return 'Posición ' . $pos . ' letra es: ' . $cadena[$pos] . ', el largo en bits es: ' . $largo
            . ', el largo en caracteres es: ' . $largo_cadena . ' y encuentro la letra ' . $letra
            . ' en  ' . $position. ' y en la otra dirección ' . $position2. '<br />'
            . ($match ? 'Si' : 'No') . ' encuentro la palabra ' . $palabra . ' en la cadena ' . $cadena . '<br />'
            . ($inicia ? 'Si' : 'No') . ' inicia con ' . $palabra . ' en la cadena ' . $cadena . '<br />'
            . ($finaliza ? 'Si' : 'No') . ' finaliza con ' . $palabra . ' en la cadena ' . $cadena . '<br />'
            . ($size == 0 ? 'Si' : 'No') . ' son iguales las cadenas ' . $palabra . ' y ' . $cadena . '<br />'
            . $subcadena . ' La subcadena ' . $cadena . ' posición ' . $pos .' y largo ' . $largo_cadena . '<br />'
            . $subcadenaI . ' La subcadena ' . $cadena . ' posición ' . $pos .' y largo ' . $largo_cadena . '<br />'
            . $cadenaR . ' La nueva cadena por ' . $letra . ' palabra ' . $palabra .' y cadena ' . $cadena . '<br />'
            . $cadenaMin . ' La nueva cadena en minúsculas  <br />'
            . $cadenaMay . ' La nueva cadena en mayúsculas <br />'
            . $letraMay . ' La nueva cadena en mayúsculas la inicial <br />'
            . $palabraMay . ' La nueva cadena en mayúsculas la palabra inicial <br />';
    }


}
