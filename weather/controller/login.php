<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    require_once("../model/claseConeccion.php");
    $obj = new Connection();
    $obj = $obj->login($correo, $contrasena);
    echo json_encode(["estado" => $obj]);
}
