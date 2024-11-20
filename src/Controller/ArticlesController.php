<?php
declare(strict_types=1);
namespace App\Controller;

use App\Service\DefaultService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $data = $request->query->get('nombre', 'Gerardo');
        $data_fac = $request->query->get('fac', 9);

        $firstValue = $a = 3;
        $secondValue = 4;

        $a += $secondValue;

        $var_switch = $this->switcheable($firstValue);
        $var_match = $this->matcheable($secondValue);

        $date = $this->getDate();
        $theTime = $this->getTime();
        $theDay = $this->getDay();
        $theRaiz = $this->getRaizCuadrada(9);

//        return new Response((string)$this->sumInt(3, 5));

        return new Response('Bienvenido a PHP Maipú: ' . $data . ',  <br/>'
            . $this->defaultService->obtenerVersionPhp() . ', <br/>'
            . $this->defaultService->obtenerSO() . ', <br/>'
            . $this->defaultService->obtenerPathExtensionPhp() . ', <br/>'
            . ' y ' . $this->defaultService->obtenerPi() . ', <br/>'
            . 'viendo los datos de $a ' . $a . ', <br/>'
            . ' y determinando si $a es mayor que $b: ' . $this->compararValores($firstValue, $secondValue) . ', <br/>'
            . ' y determinando si $a es mayor que $b pero anidado: ' . $this->compararValoresAnidados($firstValue, $secondValue) . ', <br/>'
            . $var_switch . ', <br/>'
            . $var_match . ', <br/>'
            . 'el día: ' . $date . ', <br/>'
            . 'el time: ' . $theTime . ', <br/>'
            . 'el day: ' . $theDay . ', <br/>'
            . 'la raíz: ' . $theRaiz . ', <br/>'
            . 'buscando aleatorios: ' . $this->aleatorio() . ', <br/>'
            . "factorial de {$data_fac} : " . $this->factorial($data_fac) . ', <br/>'
        );
    }

    /**
     * Esta función privada 'switcheable' toma un número como entrada y devuelve el día de la semana correspondiente.
     * Cada número del 1 al 7 representa un día de la semana comenzando por el Lunes.
     *
     * @param int $b Un número entero representando el día de la semana, donde 1 es Lunes y 7 es Domingo
     * @return string Retorno el nombre del día de la semana en español
     */
    private function switcheable(int $b): string
    {
        switch ($b) {
            case 1:
                $day = 'Lunes';
                break;
            case 2:
                $day = 'Martes';
                break;
            case 3:
                $day = 'Miércoles';
                break;
            case 4:
                $day = 'Jueves';
                break;
            case 5:
                $day = 'Viernes';
                break;
            case 6:
                $day = 'Sábado';
                break;
            case 7:
                $day = 'Domingo';
                break;
            default:
                $day = 'Error de código';
                break;
        }

        return $day;
    }

    private function matcheable($b): string
    {
        return match ($b) {
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            7 => 'Domingo',
            default => 'Error de código',
        };
    }

    protected function getDate(): string
    {
        return date('H:i:s');
    }

    protected function getTime(): int
    {
        return time();
    }

    protected function getDay(): string
    {
        $nDay = date('w');

        return $this->matcheable((int)$nDay);
    }

    protected function getRaizCuadrada($numero): float
    {
        return sqrt($numero);
    }

    /**
     * Esta función compara los dos valores proporcionados y devuelve un string que indica si el primer valor es mayor o menor que el segundo
     *
     * @param int $primerValor El primer valor a comparar
     * @param int $segundoValor El segundo valor a comparar
     * @return String "mayor" si el primer valor es mayor que el segundo, "menor" en cualquier otro caso
     */
    private function compararValores(int $primerValor, int $segundoValor): string
    {
        return $primerValor > $segundoValor ? 'mayor' : 'menor';
    }

    /**
     * Esta función compara los dos valores proporcionados de una manera anidada y devuelve un string que indica si el primer valor es mayor, menor o igual al segundo
     *
     * @param int $primerValor El primer valor a comparar
     * @param int $segundoValor El segundo valor a comparar
     * @return String "mayor" si el primer valor es mayor que el segundo, "menor" si el primer valor es menor que el segundo, "igual" si los dos valores son iguales
     */
    private function compararValoresAnidados(int $primerValor, int $segundoValor): string
    {
        return $primerValor > $segundoValor ? 'mayor' : ($primerValor < $segundoValor ? 'menor' : 'igual');
    }

    protected function aleatorio(): int
    {
        return rand(1, 100);
    }

    #[Route(path: '/articulos-json', name: 'articles-json', methods: ['GET'])]
    public function listJson(Request $request)
    {

        return new JsonResponse(['nombre' => 'Gerardo'], Response::HTTP_CREATED);
    }

    #[Route(path: '/arts-funciones', name: 'app_articles_funciones', methods: ['GET'])]
    public function getFunciones(): Response
    {
        return new Response("<body>" . $this->getBreaks() . "</body>");
    }

    private function getBreaks(): string
    {
        $text = "";
        for ($i = self::BASE; $i <= self::EXP; $i++) {

            //break
//            if($i === 4){
//                break;
//            }

//             continue
            if ($i === 4) {
                continue;
            }


            $text .= "<span>{$i}</span>";
            $text .= "<br/>";
        }

        return $text;
    }

    /**
     * @param int $number
     * @return float|int
     */
    protected function factorial(int $number = 9): float|int
    {
        $resultado = 1;

        for ($i = 1; $i <= $number; $i++) {
            $resultado = $resultado * $i;

        }

        return $resultado;

    }

    /**
     * Foreach para un array
     * @return string
     */
    private function getDays(): string
    {
        $text = "";
        foreach (self::DAYS as $key => $day) {
            $text .= "(" . $key . ") " . $day . "<br/>";
        }
        return $text;
    }

    private function paramFor(): string
    {
        $text = "";
        for ($i = self::BASE; $i <= self::EXP; $i++) {
            for ($j = self::BASE; $j <= $i; $j++) {
                $text .= "<span>*</span>";
            }
            $text .= "<br/>";
        }

        return $text;

    }

    public function valores(string $nombre, int $rating = 5): string
    {
        return "El nombre del curso {$nombre} tiene un rating de {$rating}";
    }

    public function concatenar(...$parametros): int
    {
        $result = 0;
        foreach ($parametros as $param) {
            $result += (int)$param;
        }
        return $result;
    }

    /**
     * @param int $value_1
     * @param int $value_2
     * @return int
     */
    public function sumInt(int $value_1, int $value_2):int
    {
        return $value_1 + $value_2;
    }

}
