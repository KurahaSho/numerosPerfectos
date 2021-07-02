<?php
include_once "./database_handler.php";

class NumerosPerfectos
{
    private $databaseHandler;

    public function __construct()
    {
        $this->databaseHandler = new DatabaseHandler();
    }

    public function procesarRango(
        $numeroFinal,
        $numeroInicio = 1,
    ) {
        //** Esta función establece un rango y guarda números perfectos dentro de ese rango */
        //** El ciclo en la función toma presuntos números naturales perfectos y los filtra con el if*/


        if ($numeroFinal > $numeroInicio && $numeroInicio >= 1) {
            //Este if detiene las llamadas recursivas a la app
            $sumaDivisores = 0;
            $divisores = '';

            for ($i = 1; $i < $numeroInicio; $i++) {
                if ($numeroInicio % $i == 0) {
                    $sumaDivisores += $i;
                    $divisores = $divisores . " $i ,";
                }
            }
            // $posicionPlus = strlen($divisores) - 3
            if ($sumaDivisores == $numeroInicio) {
                $this->databaseHandler->guardarNumeroPerfecto($numeroInicio, substr($divisores, 0, strlen($divisores) - 2));
            }
            $numeroInicio += 1;
            // Se llama recursivamente a la función
            $this->procesarRango($numeroFinal, $numeroInicio);
        } else if ($numeroFinal < $numeroInicio || $numeroFinal < 1 || $numeroInicio < 1) {
            header('Location: ?entradaValida=false');
        }
    }
}
