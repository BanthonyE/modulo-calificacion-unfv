<!DOCTYPE html>
<?php
require 'functions.php';
$permisos = ['Administrador','Profesor'];
permisos($permisos);
if(isset($_GET['id'])) {

    $id_profesor = $_GET['id'];

    $users = $conn->prepare("select * from users where id = ".$id_profesor);
    $users->execute();
    $users = $users->fetch();

}else{
    Die('Ha ocurrido un error');
}
?>
<html>
<head>
<title>Editar Docente</title>
    <meta name="description" content="Editar Docente" />
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
        <li class="active"><a href="admin_listado_docentes.php">Docente</a> </li>
        <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li><a href="admin_listado_Asignación.php">Asignación</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Edición de Docente</h4>
            <form method="post" class="form" action="admin_procesar_docentes.php">
                <!--colocamos un campo oculto que tiene el id del facultad-->
                <input type="hidden" value="<?php echo $users['id']?>" name="id_docente">
                
                <label>Username</label><br>
                <input type="text" required name="Username" value="<?php echo $users['username']?>" maxlength="45">
                <br>
                <label>Password</label><br>
                <input type="text" required name="Password" value="<?php echo $users['password']?>" maxlength="45">
                <br><br>
                <label>Nombre</label><br>
                <input type="text" required name="Nombre" value="<?php echo $users['nombre']?>" maxlength="45" >
                <br><br>
                <label>Rol</label><br>
                <input type="text" readonly name="Profesor" value="Profesor" value="<?php echo $users['rol']?>">
                <br><br>

                <button type="submit" name="modificar">Guardar Cambios</button> <a class="btn-link" href="admin_listado_docentes.php">Ver Listado</a>
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