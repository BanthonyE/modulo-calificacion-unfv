<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador','Profesor','Padre'];
permisos($permisos);

?>
<html>
<head>
<title>Inicio | Registro de Notas</title>
    <meta name="description" content="Registro de Notas Universidad Federico Villarreal" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Registro de Notas - Universidad Federico Villarreal</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li class="active"><a href="inicio.view.php">Inicio</a> </li>
        
        <?php if($_SESSION["rol"] == "Administrador"){ ?>
            <li><a href="admin_listado_facultad.php">Facultad</a> </li>
            <li><a href="admin_listado_carrera.php">Carrera</a> </li>
            <li><a href="admin_listado_docentes.php">Docente</a> </li>
            <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <?php } ?>
 
        <?php if($_SESSION["rol"] == "Profesor"){ ?>

   
        <li class="active"><a href="profe_listado_cursos.php">Listado de Cursos</a> </li>
        <li><a href="#">Consulta de Notas</a> </li>


        <?php } ?>

        <?php if($_SESSION["rol"] == "Padre"){ ?>
            <li><a href="notas.view.php">Cursos</a> </li>
            <li><a href="listadonotas.view.php">Notas</a> </li>
        <?php } ?>        

        <li class="right"><a href="logout.php">Salir</a> </li>

    </ul>
</nav>

<div class="body">
    <div class="panel">
           <h1 class="text-center">Universidad Nacional Federico Villarreal</h1>
        <?php
        if(isset($_GET['err'])){
            echo '<h3 class="error text-center">ERROR: Usuario no autorizado</h3>';
        }
        ?>
        <br>
        <hr>
        <p class="text-center"><strong>Integrantes GRUPO 4</strong><br><br>Evaristo Cruz Mayumi<br>Bendezu Cortez Jose Luis<br>Centeno Vargas Llora<br>Enciso Onton Bill</p>
        <br>
        </div>
</div>

<footer>

   <p>Universidad Federico Villarreal &copy; 2022</p>
</footer>

</body>

</html>