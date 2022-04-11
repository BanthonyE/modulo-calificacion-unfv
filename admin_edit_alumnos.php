<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador','Profesor'];
permisos($permisos);
if(isset($_GET['id'])) {

    $id_alumno = $_GET['id'];

    $alumno = $conn->prepare("select u.id as idusuario, u.username,u.password,i.nombres,i.apellidos,i.genero,i.correo, 
    u.rol from users as u inner join infousuarios as i on u.id=i.id_usu where u.id = ".$id_alumno);
    $alumno->execute();
    $alumno = $alumno->fetch();

}else{
    Die('Ha ocurrido un error');
}
?>
<html>
<head>
<title>Editar Alumno</title>
    <meta name="description" content="Editar Alumno" />
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
        <li class="active"><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li><a href="admin_listado_asignacion.php">Asignación</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Edición de Docente</h4>
            <form method="post" class="form" action="admin_procesar_alumnos.php">
                <!--colocamos un campo oculto que tiene el id del facultad-->
                <input type="hidden" value="<?php echo $alumno['idusuario']?>" name="id_alumno">
                
                 <label>Username</label><br>
                <input type="text" required name="Username" value="<?php echo $alumno['username']?>" maxlength="45">
                <br>
                <label>Password</label><br>
                <input type="text" required name="Password" value="<?php echo $alumno['password']?>" maxlength="45">
                <br><br>

                <label>Nombres</label><br>
                <input type="text" required name="nombres" value="<?php echo $alumno['nombres']?>" maxlength="45">
                <br>
                <label>Apellidos</label><br>
                <input type="text" required name="apellidos" value="<?php echo $alumno['apellidos']?>" maxlength="45">
                <br><br>
                <label>Genero</label><br>
                <input type="text" required name="genero" value="<?php echo $alumno['genero']?>" maxlength="45" >
                <br><br>
                <label>Correo</label><br>
                <input type="text" name="correo" value="<?php echo $alumno['correo']?>">
                <br><br>

                <label>Rol</label><br>
                <input type="text" readonly name="Alumno" value="Alumno" value="<?php echo $alumno['rol']?>">
                <br><br>

                <button type="submit" name="modificar">Guardar Cambios</button> <a class="btn-link" href="admin_listado_alumnos.php">Ver Listado</a>
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