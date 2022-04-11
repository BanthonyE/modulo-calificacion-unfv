<?php
require 'functions.php';
if($_SESSION['rol'] =='Administrador') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        try {
            $id_docente = $_GET['id'];
            $users1 = $conn->prepare("delete from infousuarios where id_usu = " . $id_docente);
            $users1->execute();
            $users = $conn->prepare("delete from users where id = " . $id_docente);
            $users->execute();
            header('location:admin_listado_docentes.php');
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