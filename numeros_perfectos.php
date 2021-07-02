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
        GMP $numeroFinal,
        GMP $numeroInicio,
    ) {
        //** Esta función establece un rango y guarda números perfectos dentro de ese rango */
        //** El ciclo en la función toma presuntos números naturales perfectos y los filtra con el if*/

        try {
            if ($numeroFinal > $numeroInicio && $numeroInicio >= gmp_init(1)) {
                //Este if detiene las llamadas recursivas a la app
                $sumaDivisores = gmp_init(0);
                $divisores = '';

                for ($i = gmp_init(1); $i < $numeroInicio; $i = gmp_add($i, 1)) {
                    if (gmp_mod($numeroInicio, $i) == gmp_init(0)) {
                        $sumaDivisores = gmp_add($i, $sumaDivisores);
                        $divisores = $divisores . " $i ,";
                    }
                }
                // $posicionPlus = strlen($divisores) - 3
                if ($sumaDivisores == $numeroInicio) {
                    $this->databaseHandler->guardarNumeroPerfecto($numeroInicio, substr($divisores, 0, strlen($divisores) - 2));
                } else {
                    header("Location: ?entradaValida=overFlowOrMaxTimeReached&numeroInicio=$numeroInicio&numeroFinal=$numeroFinal");
                }
                $numeroInicio = gmp_add($numeroInicio, gmp_init(1));
                // Se llama recursivamente a la función
                $this->procesarRango($numeroFinal, $numeroInicio);
            } else {
                header('Location: ?guardado=true');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
