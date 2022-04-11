<!DOCTYPE html>
<?php
require 'functions.php';
//Define queienes tienen permiso en este archivo
$permisos = ['Administrador'];
permisos($permisos);

//consulta de grados
$facultad = $conn->prepare("select * from facultad");
$facultad->execute();
$facultad = $facultad->fetchAll();

?>

<html>
<head>
<title> Registro de Escuela</title>
    <meta name="description" content="Registro de carreras" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Registro de Escuela</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li class="active"><a href="admin_listado_facultad.php">Facultad</a> </li>
        <li><a href="admin_listado_carrera.php">Escuela</a> </li>
        <li><a href="admin_listado_docentes.php">Docente</a> </li>
        <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
         <li><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li><a href="admin_listado_asignacion.php">Asignación</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Registro de escuela</h4>
            <form method="post" class="form" action="admin_procesar_carrera.php">
                <label>Nombre de la escuela</label><br>
                <input type="text" required name="nombrecarrera" maxlength="45">
                <br>

                <label>Facultad</label><br>
                <select name="id_facultad" required>
                    <?php foreach ($facultad as $facultad):?>
                        <option value="<?php echo $facultad['id_facultad'] ?>"><?php echo $facultad['nombrefacultad'] ?></option>
                    <?php endforeach;?>
                </select>
                
                <br><br>
                <button type="submit" name="insertar">Guardar</button> <button type="reset">Limpiar</button> <a class="btn-link" href="admin_listado_carrera.php">Ver Listado</a>
                <br><br>
                <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al almacenar el registro</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Registro almacenado correctamente!</span>';
                ?>

            </form>
        <?php
        if(isset($_GET['err']))
            echo '<span class="error">Error al guardar</span>';
        ?>
        </div>
</div>

<footer>
   <p>Universidad Federico Villarreal &copy; 2022</p>
</footer>

</body>

</html>