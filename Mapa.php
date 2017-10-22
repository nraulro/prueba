<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    $Encabezado = include 'Head_Paginas.php';
    echo $Encabezado;  
  ?>

  <?php
    $Latitud = $_GET['Lat'];
    $Longitud = $_GET['Long'];

    $Script_Map = " <script type='text/javascript'>
                      function initMap() {
                        var myLatLng = {lat: " . $Latitud . ", lng: " . $Longitud . "};

                        var map = new google.maps.Map(document.getElementById('map'), {
                          zoom: 4,
                          center: myLatLng
                        });

                        var marker = new google.maps.Marker({
                          position: myLatLng,
                          map: map,
                          title: ''
                        });
                      }
                    </script>";

    echo $Script_Map;
  ?>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php
    $menu_x = include 'Menu.php';
    echo $menu_x;
  ?>
  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Sismos</a>
        </li>
        <li class="breadcrumb-item active">Ubicacion Evento</li>
      </ol>      
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
      $Pie = include 'Footer_Paginas.php';
      echo $Pie;
    ?>

  </div>
</body>

</html>
