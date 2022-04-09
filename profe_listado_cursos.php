<?php
require 'functions.php';

$permisos = ['Profesor'];
permisos($permisos);
//consulta los alumnos para el listaddo de alumnos
$curso = $conn->prepare("select m.id, m.nombre, m.unidcreditos, m.num_evaluaciones, m.id_ciclo, m.id_periodo, d.id_usuario_docente, d.id_seccion from materias as m inner join docenteasignatura as d on m.id = d.id_materia");
$curso->execute();
$curso = $curso->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Listado de Carreras</title>
    <meta name="description" content="Módulo de calificaciones" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>módulo de calificaciones</h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li class="active"><a href="profe_listado_cursos.php">Listado de Cursos</a> </li>
        <li><a href="#">Consulta de Notas</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h4>Listado de cursos</h4>
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Nombre del curso</th>
                    <th>Créditos</th>
                    <th colspan="2">Acciones</th>
                </tr>
                <?php foreach ($curso as $curso) :?>
                <tr>
                    <?php if($curso['id_usuario_docente']==$_SESSION["id_usu"]){ ?>
                        <td align="center"><?php echo $curso['nombre'] ?></td>
                        <td align="center"><?php echo $curso['unidcreditos'] ?></td>
                        <td><a href="profe_registro_notas.php?id=<?php echo $curso['id'] ?>">Registrar Notas</a> </td>
                        <td><a href="profe_listado_alumnos.php?id=<?php echo $curso['id'] ?>">Ver alumnos</a> </td>
                    <?php } ?>
                </tr>
                <?php endforeach;?>
            </table>
                <br><br>

                <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
                <?php
                if(isset($_GET['err']))
                    echo '<span class="error">Error al almacenar el registro</span>';
                if(isset($_GET['info']))
                    echo '<span class="success">Registro almacenado correctamente!</span>';
                ?>


        </div>
</div>

<footer>
    <p>Universidad Federico Villarreal &copy; 2022</p>
</footer>

</body>

</html>