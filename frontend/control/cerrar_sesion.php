<?php
//Crear sesi�n
session_start();
//Vaciar sesi�n

if(isset($_SESSION['alias_cliente'])) {
//Destruir Sesi�n
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