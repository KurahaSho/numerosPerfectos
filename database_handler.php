<?php
class DatabaseHandler
{
    private $host = "localhost";
    private $database = "numeros_perfectos";
    private $username = "root";
    private $password = "";
    private $table = "numeros";
    public $conexion;

    public function __construct()
    {

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        /* se manejan errores de conexión */
        if (mysqli_connect_errno()) {
            printf("Conexión fallida: %s\n", mysqli_connect_error());
        }

        return $this->conn;
    }

    //** Funciones CRD para mysql */
    public function consultarNumerosPerfectos()
    {
        try {
            $sqlQuery = "SELECT * FROM " . $this->table . "";
            if ($resultado = $this->conn->query($sqlQuery)) {

                return $resultado;
            }
            return [
                'numero' =>
                'No hay registros',
                'divisores' => ''
            ];
        } catch (\Throwable $th) {
            echo 'Ocurrió un error consultando números ' . $th;
        }
    }

    public function consultarUltimoNumero()
    {
        try {
            $sqlQuery = "SELECT * FROM " . $this->table . " DESC LIMIT 1 ORDER BY numero";
            if ($resultado = $this->conn->query($sqlQuery)) {
                return
                    mysqli_fetch_row($resultado);
            }
            return [
                'numero' =>
                'No hay registros',
                'divisores' => ''
            ];
        } catch (\Throwable $th) {
            echo 'Ocurrió un error consultando números ' . $th;
        }
    }

    public function guardarNumeroPerfecto($numeroPerfecto, $divisores)
    {
        try {
            $sqlQuery = "INSERT INTO "
                . $this->table . "(numero, divisores) values ($numeroPerfecto, '$divisores')";
            $this->conn->query($sqlQuery);
            header('Location: ?guardado=true');
        } catch (\Throwable $th) {
            echo 'Ocurrió un error guardando número';
            header('Location: ?noguardado = true');
        }
    }

    public function eliminarNumeroPerfecto($idNumeroPerfecto)
    {
        try {
            $sqlQuery = "DELETE FROM  " . $this->table . " where id = $idNumeroPerfecto";
            if ($resultado = $this->conn->query($sqlQuery)) {
                header('Location: ?borrado=true');
            };
        } catch (\Throwable $th) {
            echo "Ocurrió un error borrando el número";
        }
    }
}
