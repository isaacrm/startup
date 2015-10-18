<?php
//Crear sesión
session_start();
//Vaciar sesión

if(isset($_SESSION['alias_cliente'])) {
//Destruir Sesión
    session_unset();
    session_destroy();
    echo "
		<script type=\"text/javascript\" >
		    setTimeout(\"location.href='../Login.php#login_registro'\",100);
		</script>";
    exit();
}
else
{
    echo "
		<script type=\"text/javascript\" >
		    setTimeout(\"location.href='../index.php#login_registro'\",100);
		</script>";
}

?>