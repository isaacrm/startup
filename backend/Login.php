
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/main.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/style-responsive.css">
</head>
<body class="img-responsive" style="background: url('Mantenimientos/images/bg/bg.jpg') center center fixed;">
    <div class="page-form">
        <div class="panel panel-blue">
            <div class="panel-body pan">
                <form action="validarusuario.php" class="form-horizontal" method="post">
                <div class="form-body pal">
                    <div class="col-md-12 text-center">
                        <h1 style="margin-top: -90px; font-size: 48px;">
                            WineFun</h1>
                        <br />
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <img src="Mantenimientos/images/avatar/profile-pic.png" class="img-responsive" style="margin-top: -35px;" />
                        </div>
                        <div class="col-md-9 text-center">
                            <h1>
                                Bienvenido/a.</h1>
                            <br />
                            <p>
                                WineFun. Crreamos tu mundo, creamos tus ideas.</p>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-12">
                            <div class="input-icon right">
                                <i class="fa fa-user"></i>
                                <input id="usuario" name="usuario" type="text" placeholder="Usuario" required="required" autocomplete="off" maxlength="15" class="form-control" /></div>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-12">
                            <div class="input-icon right">
                                <i class="fa fa-lock"></i>
                                <input id="password" type="password" name="contraseña" placeholder="Contraseña" autocomplete="off"  maxlength="15" required="required" class="form-control" /></div>
                        </div>
                    </div>
                    <div class="form-group mbn">
                        <div class="col-lg-12" align="right">
                            <div class="form-group mbn">
                                <div class="col-lg-3">
                                    &nbsp;
                                </div>
                                <div class="col-lg-9">
                                    <a href="recuperar_contra.php" class="btn btn-default">¿Olvidaste tu Contraseña??</a>&nbsp;&nbsp;
                                    <button type="submit" name="iniciar" class="btn btn-default" value="Iniciar Sesión">
                                        Entrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12 text-center">
            <p>&nbsp;</p>
        </div>
    </div>
</body>
</html>