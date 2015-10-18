<?php
//Crear sesión
session_start();
//Vaciar sesión

if(isset($_SESSION['alias'])) {
//Destruir Sesión
    session_unset();
    session_destroy();
    echo "
		<script type=\"text/javascript\" >
		    setTimeout(\"location.href='Login.php'\",10);
		</script>";
    exit();
}
else
{
    echo "
		<script type=\"text/javascript\" >
		    setTimeout(\"location.href='Login.php'\",10);
		</script>";
}

?>