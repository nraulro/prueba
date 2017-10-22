<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    include("Head_Paginas.php");
  ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php
    include("Menu.php");
  ?>
  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Sismos</a>
        </li>
        <li class="breadcrumb-item active">Ultimos Eventos</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Sismos Registrados <?php echo date("d-M-Y H:i:s");?></div>
        <div class="card-body">
          <div class="table-responsive">
            <?php include("Tabla_Completa.php");?>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
      <div class="card mb-3"> <!-- Mapa -->
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Ubicaciones</div>
        <div class="card-body">
          <div id="map">

            <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfUTsX5x39EgWk5NmSGQY6lv-Cce481V0&callback=initMap">
            </script>

          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div> <!-- /Mapa -->
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    
    <?php
      include("Footer_Paginas.php");
    ?>

  </div>
</body>

</html>
