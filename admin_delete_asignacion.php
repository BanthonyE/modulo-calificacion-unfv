<?php
require 'functions.php';
if($_SESSION['rol'] =='Administrador') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        try {
            $id_docasig = $_GET['id'];
            
            $users = $conn->prepare("delete from docenteasignatura where id_docasig = " . $id_docasig);
            $users->execute();
            header('location:admin_listado_asignacion.php');
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