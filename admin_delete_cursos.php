<?php
require 'functions.php';
if($_SESSION['rol'] =='Administrador') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        try {
            $id_curso = $_GET['id'];
            $cursos = $conn->prepare("delete from materias where id = " . $id_curso);
            $cursos->execute();
            header('location:admin_listado_cursos.php');
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