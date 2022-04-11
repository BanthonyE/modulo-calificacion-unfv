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

    $cursos = $conn->prepare("select * from materias");
    $cursos->execute();
    $cursos = $cursos->fetchAll();

      $seccion = $conn->prepare("select * from secciones");
    $seccion->execute();
    $seccion = $seccion->fetchAll();

}else{
    Die('Ha ocurrido un chee');
}
?>
<html>
<head>
<title>Asignar Docente</title>
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
        <li ><a href="admin_listado_docentes.php">Docente</a> </li>
        <li><a href="admin_listado_alumnos.php">Alumno</a> </li>
        <li><a href="admin_listado_cursos.php">Cursos</a> </li>
        <li class="active"><a href="admin_listado_asignacion.php">Asignación</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Asignación de Docente</h4>
            <form method="post" class="form" action="admin_procesar_asignacion_docentes.php">
                <!--colocamos un campo oculto que tiene el id del facultad-->
                <input type="hidden" value="<?php echo $users['id']?>" name="id_docente">
                
                <label>Asignaturas</label><br>
                <select name="asignatura" required>
                    <?php foreach ($cursos as $c):?>
                        <option value="<?php echo $c['id'] ?>" ><?php echo $c['nombre'] ?></option>
                    <?php endforeach;?>
                </select>
                <br>
                <label>Seccion</label><br>
                <select name="seccion" required>
                    <?php foreach ($seccion as $s):?>
                        <option value="<?php echo $s['id'] ?>" ><?php echo $s['nombre'] ?></option>
                    <?php endforeach;?>
                </select>
                <br>
                <label>Codigo Docente</label><br>
                <input type="text" readonly name="id_docente" value="<?php echo $users['id'] ?>">
               <br>
               <br>
                <label>Nombre</label><br>
                <input type="text" readonly name="nombre" value="<?php echo $users['nombre'] ?>">
               <br>
                <br>
                <label>Rol Desempeñado</label><br>
                <input type="text" readonly name="rol" value="<?php echo $users['rol'] ?>">
               <br>

                <button type="submit" name="insertar">Guardar Cambios</button> <a class="btn-link" href="admin_listado_docentes.php">Ver Listado</a>
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