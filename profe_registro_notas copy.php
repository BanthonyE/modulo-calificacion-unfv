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
        <li class="active"><a href="profe_listado_cursos.php">Listado de Cursos</a> </li>
        <li><a href="#">Consulta de Notas</a> </li>
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
            $sqlalumnos = $conn->prepare("select m.id as idmateria, m.nombre, m.num_evaluaciones,n.nota1,n.observaciones, a.id as idalumno, a.nombres,a.apellidos from materias as m inner join notas as n on m.id = n.id_materia inner join alumnos as a on n.id_alumno = a.id where m.id =".$id_curso);
            $sqlalumnos->execute();
            $alumnos = $sqlalumnos->fetchAll();
            $num_alumnos = $sqlalumnos->rowCount();
            ?>
            <br>
            <a href="notas.view.php"><strong><< Volver</strong></a>
            <br>
            <br>
                <form action="profe_procesar_nota.php" method="post">

            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                    <th>#</th><th>Apellidos</th><th>Nombres</th>
                    <?php
                        for($i = 1; $i <= $num_eval; $i++){
                            
                           echo '<th>Nota '.$i .'</th>';
                        }
                    ?>
                    <th>Promedio</th>
                    <th>Observaciones</th>
                    <th>Eliminar</th>
                </tr>

                <?php 
                    $index_id_alumno=0;
                    $promedio = 0;
                ?>
                <?php foreach ($alumnos as $index => $alumno) :?>


                    <?php
                        for($i = 1; $i <= $num_eval; $i++){
                            $promedio = $promedio + $alumno['nota1'];                           
                        }

                        $promedio = $promedio/$num_eval;
                    ?>                    
                    
                    <!-- campos ocultos necesarios para realizar el insert-->
                    <input type="hidden" value="<?php echo $num_alumnos ?>" name="num_alumnos">
                    
                    <input type="hidden" value="<?php echo $alumno['idalumno'] ?>" name="<?php echo 'id_alumno'.$index ?>">
                    
                    <input type="hidden" value="<?php echo $num_eval ?>" name="num_eval">
                     <!-- campos para devolver los parametros en el get y mantener los mismos datos al hacer el header location-->
                    <input type="hidden" value="<?php echo $id_curso ?>" name="id_curso">                    

                    <?php if(strcmp(''.$alumno['idalumno'],''.$index_id_alumno)){ ?>

                        <tr>
                            <td align="center">1</td>
                            <td><?php echo $alumno['apellidos'] ?></td>
                            <td><?php echo $alumno['nombres'] ?></td>

                            <?php

                            if(existeNota($alumno['idalumno'],$id_curso,$conn) > 0){
                                    //ya tiene notas registradas
                                    $notas = $conn->prepare("select id, nota1 from notas where id_alumno = ".$alumno['idalumno']." and id_curso = ".$id_curso);
                                    $notas->execute();
                                    $registrosnotas = $notas->fetchAll();
                                    $num_notas = $notas->rowCount();                                

                                    foreach ($registrosnotas as $eval => $nota){
                                        $auxi = "evaluacion" . $eval . "alumno" . $index;
                                        echo $auxi;
                                        echo '<input type="hidden" value="'.$nota['id'].'" name="idnota' . $eval .'alumno' . $index . '">';
                                        echo '<td><input type="text" maxlength="5" value="'.$nota['nota1'].'" name="'.$auxi.'" class="txtnota"></td>';
                                    }

                                    if($num_eval > $num_notas){
                                        $dif = $num_eval - $num_notas;

                                        for($i = $num_notas; $i < $dif + $num_notas; $i++) {
                                            $auxi2 = "evaluacion" . $i . "alumno" . $index;
                                            echo $auxi2;
                                            echo '<input type="hidden" value="'.$nota['id'].'" name="idnota' . $i .'alumno' . $index . '">';
                                            echo '<td><input type="text" maxlength="5" value="'.$nota['nota1'].'" name="'.$auxi2.'" class="txtnota"></td>';
                                        }
                                    }                                
                                }else {
                                    //extrayendo el numero de evaluaciones para esa materia seleccionada
                                    for($i = 0; $i < $num_eval; $i++) {
                                        echo '<td><input type="text" maxlength="5" name="evaluacion' . $i . 'alumno' . $index . '" class="txtnota"></td>';
                                    }
                                }

                                echo '<td align="center">'.number_format($promedio, 2).'</td>';

                                if(existeNota($alumno['idalumno'],$id_curso,$conn) > 0){
                                    echo '<td><input type="text" maxlength="100" value="'.$alumno['observaciones'].'" name="observaciones' . $index . '" class="txtnota"></td>';
                                }else {
                                    echo '<td><input type="text" name="observaciones' . $index . '" class="txtnota"></td>';
                                }

                            if(existeNota($alumno['idalumno'],$id_curso,$conn) > 0){
                                echo '<td><a href=#">Eliminar</a> </td>';
                            }else{
                                echo '<td>Sin notas</td>';
                            }
                            ?>
                        </tr>
                        <?php $index_id_alumno=$alumno['idalumno']; ?>
                    <?php } ?>
                <?php $index++; endforeach; ?>
                <tr></tr>
            </table>
                <br>
                <button type="submit" name="insertar">Guardar</button> <button type="reset">Limpiar</button>
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