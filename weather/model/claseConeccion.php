<?php

class Connection
{
    public $drive;
    public $host;
    public $user;
    public $password;
    public $database;
    public $conn;

    function __construct()
    {

        $this->drive = "mysql";
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "root";
        $this->database = "clima";
        $this->conn = "";

        $this->get_Connection();
    }

    public function get_connection(){

        $this->conn = new PDO($this->drive.":"."host=".$this->host.";"."dbname=".$this->database, $this->user, $this->password);

        if (!$this->conn){
          echo "Error al conectar";
        }
        else{
          // echo"Conexion establecida";
        }
    }

    public function insertUser($nombre,$correo,$contrasena){

        $sql = "call web_sp_register(?,?,?)";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1,$nombre);
        $statement->bindParam(2,$correo);
        $statement->bindParam(3,$contrasena);

        if($statement->execute()){
            return "Usuario registrado";
        } else {
            return "Usuario no se pudo registrar";
        }
    }


    function login($correo,$contrasena){
        $sql= "call web_sp_login(?,?)";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1,$correo);
        $statement->bindParam(2,$contrasena);
        if($statement->execute()){
            $datos = $statement->fetchAll(PDO::FETCH_ASSOC);
            $count = $statement->rowCount();
            if($count){

                $cookie_name = "sesion";
                $cookie_value = $datos[0]['nombre_completo'];
                setcookie($cookie_name,$cookie_value, time() + (86400 * 30), "/");
                return true;
            }
            else{
                return false;
            }
        }
    }
    function loginF($correo){
        $sql= "call web_sp_loginF(?)";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1,$correo);

        if($statement->execute()){
            $count = $statement->rowCount();
            $datos = $statement->fetchAll(PDO::FETCH_ASSOC);
            if($count){

                $cookie_name = "sesion";
                $cookie_value = $datos[0]['nombre_completo'];;
                setcookie($cookie_name,$cookie_value, time() + (86400 * 30), "/");
                return true;
            }
            else{
                return false;
            }
        }
    }
}

$obj = new Connection();
