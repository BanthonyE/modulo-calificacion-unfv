<?php
require 'functions.php';
if($_SESSION['rol'] =='Administrador') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        try {
            $id_carrera = $_GET['id'];
            $facultad = $conn->prepare("delete from carrera where id_carrera = " . $id_carrera);
            $facultad->execute();
            header('location:admin_listado_carrera.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        die('Ha ocurrido un error');
    }
}else{
    header('location:inicio.view.php?err=1');
}
?>