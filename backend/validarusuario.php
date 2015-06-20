<?php

/*caturamos nuestros datos que fueron enviados desde el formulario mediante el metodo POST
**y los almacenamos en variables.*/
if(!empty($_POST)) {
    $usuario = $_POST["usuario"];
    $contraseña = sha1($_POST["contraseña"]);
    /*Consulta de mysql con la que indicamos que necesitamos que seleccione
    **solo los campos que tenga como nombre_administrador el que el formulario
    **le ha enviado*/
    require("bd2.php");
    $result = mysql_query("SELECT alias,contrasena, id_empleado FROM usuarios WHERE alias ='$usuario' AND estado=1");
    if($result === FALSE) {
        die(mysql_error()); // TODO: better error handling
    }
//Validamos si el nombre del administrador existe en la base de datos o es correcto
    if ($row = mysql_fetch_array($result)) {
//Si el usuario es correcto ahora validamos su contraseña
        if ($row["contrasena"] == $contraseña) {
            //Creamos sesión
            session_start();
            //Almacenamos el nombre de usuario en una variable de sesión usuario
            $_SESSION['alias'] = $usuario;
            $_SESSION['id_empleado'] = $empleado;
            //Redireccionamos a la pagina: index.php
            header("Location: index.php");
        } else {
            //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
            ?>

            <script language="JavaScript">
                alert("Contraseña Incorrecta");
                location.href = "Login.php";
            </script>

        <?php
        }
    } else {
        //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
        ?>
        <script language="JavaScript">
            alert("El nombre de usuario es incorrecto!");
            location.href = "Login.php";
        </script>
        }

    <?php
    }

//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
    mysql_free_result($result);
    /*Mysql_close() se usa para cerrar la conexión a la Base de datos y es
    **necesario hacerlo para no sobrecargar al servidor, bueno en el caso de
    **programar una aplicación que tendrá muchas visitas ;) .*/
    mysql_close();
}
?>
