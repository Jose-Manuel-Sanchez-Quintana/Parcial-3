<?php

if($_SERVER['REQUEST_METHOD']=="POST"){

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    require_once("../model/claseConeccion.php");
    $obj = new Connection();
    $resultado = $obj->insertUser($nombre,$correo,$contrasena);
    echo json_encode(["estado"=>$resultado]);
}