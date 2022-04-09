<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador','Profesor'];
permisos($permisos);
if(isset($_GET['id'])) {

    $id_curso = $_GET['id'];

    $curso = $conn->prepare("select * from materias where id = ".$id_curso);
    $curso->execute();
    $curso = $curso->fetch();

    
    $periodo = $conn->prepare("select * from periodo");
    $periodo->execute();
    $periodo = $periodo->fetch();

}else{
    Die('Ha ocurrido un error');
}
?>
<html>
<head>
<title>Editar Cursos</title>
    <meta name="description" content="Editar Cursos" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Modulo Calificaciones</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li ><a href="admin_listado_facultad.php">Facultad</a> </li>
        <li><a href="admin_listado_carrera.php">Carrera</a> </li>
        <li ><a href="admin_listado_docentes.php">Docente</a> </li>
        <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li class="active"><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li><a href="admin_listado_Asignación.php">Asignación</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Edición de Cursos</h4>
            <form method="post" class="form" action="admin_procesar_cursos.php">
                <!--colocamos un campo oculto que tiene el id del facultad-->
                <input type="hidden" value="<?php echo $curso['id']?>" name="id_curso">
                
                <label>Nombre</label><br>
                <input type="text" required name="nombre"  value="<?php echo $curso['nombre']?>" maxlength="45">
                <br>
                <label>N° Evaluaciones</label><br>
                <input type="text" required name="num_evaluaciones" value="<?php echo $curso['num_evaluaciones']?>" maxlength="45">
                <br><br>
                <label>Uni. Cred.</label><br>
                <input type="text" required name="unidcreditos" value="<?php echo $curso['unidcreditos']?>" maxlength="45" >
                <br><br>
                <label>Ciclo</label><br>
                <select name="ciclo" id="ciclo">
                <option value="<?php echo $curso['id_ciclo']?>">Ciclo <?php echo $curso['id_ciclo']?></option>
                <option value="1">Ciclo 1</option>
                <option value="2">Ciclo 2</option>
                <option value="3">Ciclo 3</option>
                <option value="4">Ciclo 4</option>
                <option value="5">Ciclo 5</option>
                <option value="6">Ciclo 6</option>
                <option value="7">Ciclo 7</option>
                <option value="8">Ciclo 8</option>
                <option value="9">Ciclo 9</option>
                <option value="10">Ciclo 10</option>
                </select>
                <br><br>
                <label>Periodo</label><br>
                <select name="periodo" required>
                    <option value="<?php echo $curso['id_periodo']?>">Periodo <?php echo $curso['id_periodo']?></option>
                    <option value="1">Periodo 1</option>
                    <option value="2">Periodo 2</option>
                </select>
                <br><br>
                <br><br>

                <button type="submit" name="modificar">Guardar Cambios</button> <a class="btn-link" href="admin_listado_cursos.php">Ver Listado</a>
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