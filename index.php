<?php
//arreglo con mensajes que puede recibir
$messages = [
    "1" => "Credenciales incorrectas",
    "2" => "No ha iniciado sesión"
];
?>
<!DOCTYPE html>
<html>
<head>
<title>Login | Registro de Notas</title>
    <meta name="description" content="Registro de Notas Federico Villarreal" />
    <link rel="stylesheet" href="css/style.css" />

</head>
<body>
<div class="header">
<center> 
        <h1>Registro de Notas - Universidad Federico Villarreal"</h1>
</center> 
</div>

<div class="body">
    <div class="panel-login">
         <center> 
            <h4>Inicio de Sesion</h4>
            </center> 
            <form method="post" class="form" action="http://localhost:90/ModuloCalificaciones/login_post.php">
                <label>Usuario</label><br>
                <input type="text" name="username">
                <br>
                <label>Contraseña</label><br>
                <input type="password" name="password">
                <br><br>
                <center> 
                <button type="submit">Entrar</button>
</center> 
            </form>
        <?php
        if(isset($_GET['err']) && is_numeric($_GET['err']) && $_GET['err'] > 0 && $_GET['err'] < 3 )
            echo '<span class="error">'.$messages[$_GET['err']].'</span>';
        ?>
        </div>
        <center> <img src="imag.jpg" height="400px"></center>
       
</div>

<footer>
    <p>Universidad Federico Villarreal &copy; 2022</p>
</footer>

</body>

</html>
