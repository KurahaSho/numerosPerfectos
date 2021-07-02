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
        $guardar = false
    ) {
        if ($numeroFinal > $numeroInicio && $numeroInicio >= 1) {
            $this->esNumeroPerfecto($numeroInicio, $guardar);
            $numeroInicio += 2;
            $this->procesarRango($numeroFinal, $numeroInicio, $guardar);
        } else {
            header('Location: ?entradaValida=false');
        }
    }

    public function esNumeroPerfecto($numero, $guardar = false)
    {
        $sumaDivisores = 0;
        $divisores = '';

        for ($i = 1; $i < $numero; $i++) {
            if ($numero % $i == 0) {
                $sumaDivisores += $i;
                $divisores = " $i ,";
            }
        }
        if ($guardar) {
            if ($sumaDivisores == $numero) {
                $this->databaseHandler->guardarNumeroPerfecto($numero, $divisores);
            }
        }
    }
}
