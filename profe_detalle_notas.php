<!DOCTYPE html>
<?php
require 'functions.php';

$permisos = ['Profesor'];
permisos($permisos);


?>
<html>
<head>
    <title>Detalle de Notas</title>
    <meta name="description" content="Detalle de Notas de Federico Villarreal" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
    <h1>Detalle de notas</h1>
    <h3>Usuario:  <?php echo $_SESSION["username"] ?></h3>
</div>
<nav>
    <ul>
        <li><a href="inicio.view.php">Inicio</a> </li>
        <li><a href="alumnos.view.php">Registro de Alumnos</a> </li>
        <li><a href="listadoalumnos.view.php">Listado de Alumnos</a> </li>
        <li><a href="notas.view.php">Registro de Notas</a> </li>
        <li class="active"><a href="listadonotas.view.php">Consulta de Notas</a> </li>
        <li class="right"><a href="logout.php">Salir</a> </li>

    </ul>
</nav>

<div class="body">
    <div class="panel">
        <h3>Consulta de Notas</h3>
        <?php
        if(isset($_GET['id'])){
            $id_alumno = $_GET['id'];

            $idcurso = $_GET['idcurso'];

            //extrayendo el numero de evaluaciones para esa materia seleccionada
            $notas = $conn->prepare("select m.id as idmateria, m.nombre,aa.id_alum, m.num_evaluaciones, n.nota1, n.nota2, n.nota3, n.parcial, n.final, n.promedio1, n.sustitutorio, n.aplazado, n.observaciones, i.nombres, i.apellidos from materias as m inner join alumasignatura as aa on aa.id_asignatura=m.id inner join notas as n on n.id_alumasig=aa.id inner join infousuarios as i on i.id_usu=aa.id_alum where aa.id_alum =".$id_alumno." and aa.id_asignatura=".$idcurso);
            $notas->execute();
            $notas = $notas->fetchAll();
            ?>

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
                    <th>Acci??n</th>
                </tr>
                <?php foreach ($notas as $index => $alumno) :?>

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

                </table>

                <br>
                <button type="reset" onclick="window.location.href='profe_listado_alumnos.php?id=<?php echo $idcurso ?>'">Regresar</button>

        <?php
        }
        ?>
    </div>
</div>

<footer>
    <p>Universidad Federico Villarreal &copy; 2022</p>
</footer>

</body>
<script>
    <?php
    for($i = 0; $i < $num_eval; $i++){
        echo 'var values'.$i.' = [];
        var promedio'.$i.';
    var valor'.$i.' = 0;
    var nota'.$i.' = document.getElementsByName("nota'.$i.'");
    for(var i = 0; i < nota'.$i.'.length; i++) {
        valor'.$i.' += parseFloat(nota'.$i.'[i].value);
    }
    promedio'.$i.' = (valor'.$i.' / parseFloat(nota'.$i.'.length));
    document.getElementById("promedio'.$i.'").innerHTML = (promedio'.$i.').toFixed(2);';

    }
    ?>
</script>

</html>