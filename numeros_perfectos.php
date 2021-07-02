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
        for ($i = $numeroInicio; $i <= $numeroFinal; $i++) {
            $this->esNumeroPerfecto($i, $guardar);
        }
    }

    public function esNumeroPerfecto($numero, $guardar = false)
    {
        $sumaDivisores = 0;
        $divisores = array();

        for ($i = 1; $i <= ceil(sqrt($numero)); $i++) {
            if ($numero % $i == 0) {
                $sumaDivisores += $i;
                $divisores[] = $i . ',';
            }
        }
        if ($sumaDivisores == $numero) {
            $this->databaseHandler->guardarNumeroPerfecto($numero, $divisores);
        }
    }
}
