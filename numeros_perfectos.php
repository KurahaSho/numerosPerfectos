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
        if ($numeroFinal > $numeroInicio && $numeroInicio >= 1) {
            $sumaDivisores = 0;
            $divisores = '';

            for ($i = 1; $i < $numeroInicio; $i++) {
                if ($numeroInicio % $i == 0) {
                    $sumaDivisores += $i;
                    $divisores = $divisores . " $i ,";
                }
            }
            $posicionPlus = strlen($divisores) - 1;
            if ($sumaDivisores == $numeroInicio) {
                $this->databaseHandler->guardarNumeroPerfecto($numeroInicio, str_replace('+', '', $divisores, $posicionPlus));
            }
            $numeroInicio += 1;
            $this->procesarRango($numeroFinal, $numeroInicio);
        } else {
            header('Location: ?entradaValida=false');
        }
    }
}
