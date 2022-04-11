<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador','Profesor'];
permisos($permisos);
if(isset($_GET['id'])) {

    $id_carrera = $_GET['id'];

    $carrera = $conn->prepare("select * from carrera where id_carrera = ".$id_carrera);
    $carrera->execute();
    $carrera = $carrera->fetch();

    $facultad = $conn->prepare("select * from facultad");
    $facultad->execute();
    $facultad = $facultad->fetchAll();

}else{
    Die('Ha ocurrido un error');
}
?>
<html>
<head>
<title>Registro de Escuela</title>
    <meta name="description" content="Módulo de Calificaciones" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Módulo de Calificaciones</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="admin_listado_facultad.php">Facultad</a> </li>
        <li class="active"><a href="admin_listado_carrera.php">Carrera</a> </li>
        <li><a href="admin_listado_docentes.php">Docente</a> </li>
        <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li><a href="admin_listado_asignacion.php">Asignación</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Edición de Escuela</h4>
            <form method="post" class="form" action="admin_procesar_carrera.php">
                <!--colocamos un campo oculto que tiene el id del alumno-->
                <input type="hidden" value="<?php echo $carrera['id_carrera']?>" name="id_carrera">
                <label>Nombre de la escuela</label><br>
                <input type="text" required name="nombrecarrera" value="<?php echo $carrera['nombrecarrera']?>" maxlength="45">
                <br>
                <label>Facultad</label><br>
                <select name="id_facultad" required>
                    <?php foreach ($facultad as $facultad):?>
                        <option value="<?php echo $facultad['id_facultad'] ?>" <?php if($carrera['id_facultad'] == $facultad['id_facultad']) { echo "selected";} ?> ><?php echo $facultad['nombrefacultad'] ?></option>
                    <?php endforeach;?>
                </select>
                <br><br>
                <button type="submit" name="modificar">Guardar Cambios</button> <a class="btn-link" href="admin_listado_carrera.php">Ver Listado</a>
                <br><br>
                <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al editar el registro</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Registro modificado correctamente!</span>';
                ?>

            </form>
        </div>
</div>

<footer>
   <p>Universidad Federico Villarreal &copy; 2022</p>
</footer>

</body>

</html>