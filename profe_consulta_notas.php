<!DOCTYPE html>
<?php
require 'functions.php';
//arreglo de permisos
$permisos = ['Administrador','Profesor', 'Alumno'];
permisos($permisos);

//consulta las materias
$materias = $conn->prepare("select * from materias");
$materias->execute();
$materias = $materias->fetchAll();


if(isset($_GET['id'])) {

    $id_curso = $_GET['id'];

}else{
    Die('Ha ocurrido un error');
}

?>
<html>
<head>
<title>Notas | Registro de Notas</title>
    <meta name="description" content="Universidad Federico Villarreal" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
        <h1>Registro de Notas </h1>
        <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="profe_listado_cursos.php">Listado de Cursos</a> </li>
        <li class="active"><a href="#">Consulta de Notas</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>
    </ul>
</nav>

<div class="body">
    <div class="panel">
            <h3>Registro y Modificación Notas</h3>
           <?php
           if(!isset($_GET['id'])){
               ?>

            <form method="get" class="form" action="notas.view.php">
                <label>Seleccione el Grado</label><br>
                <select name="grado" required>
                    <?php foreach ($grados as $grado):?>
                        <option value="<?php echo $grado['id'] ?>"><?php echo $grado['nombre'] ?></option>
                    <?php endforeach;?>
                </select>
                <br><br>
                <label>Seleccione la Materia</label><br>
                <select name="materia" required>
                    <?php foreach ($materias as $materia):?>
                        <option value="<?php echo $materia['id'] ?>"><?php echo $materia['nombre'] ?></option>
                    <?php endforeach;?>
                </select>

                <br><br>
                <label>Seleccione la Sección</label><br>

                <?php foreach ($secciones as $seccion):?>
                    <input type="radio" name="seccion" required value="<?php echo $seccion['id'] ?>">Sección <?php echo $seccion['nombre'] ?>
                <?php endforeach;?>

                <br><br>
                <button type="submit" name="revisar" value="1">Ingresar Notas</button> <a class="btn-link" href="listadonotas.view.php">Consultar Notas</a>
                <br><br>
            </form>
        <?php
           }
        ?>
        <hr>

        <?php
        if(isset($_GET['id'])){
            
            //extrayendo el numero de evaluaciones para esa materia seleccionada
            $num_eval = $conn->prepare("select num_evaluaciones from materias where id = ".$id_curso);
            $num_eval->execute();
            $num_eval = $num_eval->fetch();
            $num_eval = $num_eval['num_evaluaciones'];


            //mostrando el cuadro de notas de todos los alumnos del grado seleccionado
            $sqlalumnos = $conn->prepare("select m.id as idmateria, m.nombre,aa.id_alum, m.num_evaluaciones, n.nota1, n.nota2, n.nota3, n.parcial, n.final, n.promedio1, n.sustitutorio, n.aplazado, n.observaciones, i.nombres, i.apellidos from materias as m inner join alumasignatura as aa on aa.id_asignatura=m.id inner join notas as n on n.id_alumasig=aa.id inner join infousuarios as i on i.id_usu=aa.id_alum where aa.id_asignatura=".$id_curso);
            $sqlalumnos->execute();
            $alumnos = $sqlalumnos->fetchAll();
            $num_alumnos = $sqlalumnos->rowCount();
            ?>
            <br>
            <button type="submit" name="insertar">Descargar reporte de notas</button>
            <br>
            <br>
                <form action="profe_procesar_nota.php" method="post">

            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                    <th>#</th><th>Apellidos</th><th>Nombres</th>
                    <th>Nota 1</th>
                    <th>Nota 2</th>
                    <th>Nota 3</th>
                    <th>Parcial</th>
                    <th>Final</th>
                    <th>Prom. 1</th>
                    <th>Sustitutorio</th>
                    <th>Promedio</th>
                    <th>Observaciones</th>
                    <th>Eliminar</th>
                </tr>


                <?php foreach ($alumnos as $index => $alumno) :?>

                    <?php 
                        $index_id_alumno=0;
                        $prom1= ($alumno['nota1']+$alumno['nota2']+$alumno['nota3']+$alumno['parcial']+$alumno['final'])/5;
                    ?>                
                    
                    <!-- campos ocultos necesarios para realizar el insert-->
                    <input type="hidden" value="<?php echo $num_alumnos ?>" name="num_alumnos">
                    
                    <input type="hidden" value="<?php echo $alumno['id_alum'] ?>" name="<?php echo 'id_alumno'.$index ?>">
                    
                    <input type="hidden" value="<?php echo $num_eval ?>" name="num_eval">
                     <!-- campos para devolver los parametros en el get y mantener los mismos datos al hacer el header location-->
                    <input type="hidden" value="<?php echo $id_curso ?>" name="id_curso">    
                                

                    <?php if(strcmp(''.$alumno['id_alum'],''.$index_id_alumno)){ ?>

                        <tr>
                        <td align="center">1</td>
                            <td><?php echo $alumno['apellidos'] ?></td>
                            <td><?php echo $alumno['nombres'] ?></td>

                            <td><?php echo $alumno['nota1'] ?></td>

                            <td><?php echo $alumno['nota2'] ?></td>

                            <td><?php echo $alumno['nota3'] ?></td>

                            <td><?php echo $alumno['parcial'] ?></td>

                            <td><?php echo $alumno['final'] ?></td>

                            <td><?php echo $prom1 ?></td>

                            <td><?php echo $alumno['sustitutorio'] ?></td>
                        
                            <td><?php echo $alumno['sustitutorio'] ?></td>

                            <td><?php echo $alumno['observaciones'] ?></td>

                            <td><a href="#">Corregir</a></td>

                        </tr>
                        <?php $index_id_alumno=$alumno['id_alum']; ?>
                    <?php } ?>
                <?php $index++; endforeach; ?>
                <tr></tr>
            </table>
                <br>
                <button type="reset" onclick="window.location.href='profe_listado_alumnos.php?id=<?php echo $id_curso ?>'">Regresar</button>
                <br>
            </form>


        <?php }

        ?>
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