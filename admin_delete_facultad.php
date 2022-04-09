<?php
require 'functions.php';
if($_SESSION['rol'] =='Administrador') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        try {
            $id_facultad = $_GET['id'];
            $facultad = $conn->prepare("delete from facultad where id_facultad = " . $id_facultad);
            $facultad->execute();
            header('location:admin_listado_facultad.php');
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


