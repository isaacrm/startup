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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
      <![endif]-->
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->
      <?php include 'mant_funciones/header.php';?>
      <?php include 'mant_funciones/aside.php';?>
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
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Mantenimiento de Empleados
                          </header>
                          <div class='container'>
                              <div class='row'>
                                  <h2>Mantenimiento de usuarios</h2>
                              </div>
                              <div class='row'>
                                  <p><a class='btn btn-xs btn-success' href='mant_funciones/create.php'>Crear</a></p>
                                  <table class='table table-striped table-bordered table-hover'>
                                      <tr class='warning'>
                                          <th>ID</th>
                                          <th>NOMBRE</th>
                                          <th>DESCRIPCION</th>
                                          <th>ACCIÓN</th>
                                      </tr>
                                      <tbody>
                                      <?php
                                      require("../../bd.php");
                                      $sql = "SELECT id_funcion, nombre, descripcion FROM funciones ORDER BY id_funcion ASC";
                                      $data = "";
                                      foreach($PDO->query($sql) as $row) {
                                          $data .= "<tr>";
                                          $data .= "<td>$row[id_funcion]</td>";
                                          $data .= "<td>$row[nombre]</td>";
                                          $data .= "<td>$row[descripcion]</td>";
                                          $data .= "<td>";
                                          $data .= "<a class='btn btn-xs btn-info' href='read.php?id=$row[id_funcion]'>Consultar</a>&nbsp;";
                                          $data .= "<a class='btn btn-xs btn-primary' href='update.php?id=$row[id_funcion]'>Actualizar</a>&nbsp;";
                                          $data .= "<a class='btn btn-xs btn-danger' href='delete.php?id=$row[id_funcion]'>Eliminar</a>";
                                          $data .= "</td>";
                                          $data .= "</tr>";
                                      }
                                      print($data);
                                      $PDO = null;
                                      ?>
                                      </tbody>
                                  </table>
                              </div> <!-- /row -->
                      </section>
                  </div>
              </div>

              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section end -->

    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- jquery validate js -->
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>

    <!-- custom form validation script for this page-->
    <script src="js/form-validation-script.js"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>


  </body>
</html>
