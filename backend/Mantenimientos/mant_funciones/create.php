<?php 
    if(!empty($_POST)) {
        // validation errors
        $nombresError = null;
        $descripcionError = null;
        // post values
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        
        // validate input
        $valid = true;
        if(empty($nombre)) {
            $nombresError = "Por favor ingrese los nombres.";
            $valid = false;
        }
        
        if(empty($descripcion)) {
            $descripcionError = "Por favor ingrese la descripcion.";
            $valid = false;
        }
        // insert data
        if($valid) {
            require("../../bd.php");
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO funciones(nombre, descripcion) values(?, ?)";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($nombre , $descripcion));
            $PDO = null;
            header("Location: form_validation.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Form Validation | Creative - Bootstrap 3 Responsive Admin Template</title>

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="../css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="../css/elegant-icons-style.css" rel="stylesheet" />
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
    <script src="../js/respond.min.js"></script>
    <script src="../js/lte-ie7.js"></script>
    <![endif]-->
</head>

<body>
<!-- container section start -->
<section id="container" class="">
    <!--header start-->
    <?php include 'header.php';?>
    <?php include 'aside.php';?>
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-files-o"></i> Form Validation</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                        <li><i class="icon_document_alt"></i>Forms</li>
                        <li><i class="fa fa-files-o"></i>Form Validation</li>
                    </ol>
                </div>
            </div>
            <!-- Form validations -->
            <div class='row'>
                <div class='row'>
                    <h2>Crear funciones de tipos de usuario</h2>
                </div>
                <form method='POST'>
                    <div class='form-group <?php print(!empty($nombresError)?"has-error":""); ?>'>
                        <label for='nombres'>Nombre</label>
                        <input type='text' name='nombre' placeholder='Nombre' required='required' id='nombre' class='form-control' value='<?php print(!empty($nombre)?$nombre:""); ?>'>
                        <?php print(!empty($nombresError)?"<span class='help-block'>$nombresError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($descripcionError)?"has-error":""); ?>'>
                        <label for='descripcion'>Descripción</label>
                        <input type='text' name='descripcion' placeholder='Descripción' required='required' id='descripcion' class='form-control' value='<?php print(!empty($descripcion)?$descripcion:""); ?>'>
                        <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
                    </div>
                    <div class='form-actions'>
                        <button type='submit' class='btn btn-success'>Crear</button>
                        <a class='btn btn btn-default' href='../form_validation.php'>Regresar</a>
                    </div>
                </form>
            </div> <!-- /row -->

            <!-- page end-->
        </section>
    </section>
    <!--main content end-->
</section>
<!-- container section end -->

<!-- javascripts -->
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!-- nice scroll -->
<script src="../js/jquery.scrollTo.min.js"></script>
<script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
<!-- jquery validate js -->
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>

<!-- custom form validation script for this page-->
<script src="../js/form-validation-script.js"></script>
<!--custome script for all page-->
<script src="../js/scripts.js"></script>


</body>
</html>
