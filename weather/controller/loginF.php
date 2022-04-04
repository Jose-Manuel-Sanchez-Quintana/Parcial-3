<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $correo = $_POST['email'];
 


    require_once("../model/claseConeccion.php");
    $obj = new Connection();
    $obj = $obj->loginF($correo);
    echo json_encode(["estado" => $obj]);
}
