<!DOCTYPE html>
<html lang="en">

<head>
  
  <?php
     $Encabezado = include 'Head_Paginas.php';
     echo $Encabezado;   
      
  ?>

  <script>
    var time = setInterval(Busca_Evento, 1000);
    var ultimos_eventos;
    function Busca_Evento(){
      var fecha = new Date();
      document.getElementById("hora").innerHTML = "Hora actual: " + fecha.toLocaleTimeString();      

      $.ajax({
        dataType: 'json',
        url: "https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&starttime=2017-10-13",
        success: function(data){
          //var j = '[{ "name":"John", "age":30, "city":"New York"}]';
          //var types = JSON.parse(data.metadata);
          //document.getElementById("json").innerHTML = "";
          //document.getElementById("json").innerHTML = data.metadata.count;
          document.getElementById("json").innerHTML = data.features[0].type;
          //var propiedades_sismo = JSON.parse(data.features[0]);
          var i = 1;
          document.getElementById("json").innerHTML = '<tr><td>' + data.features[i-1].properties.place +'--'+ data.metadata.count + '**</td><td>' + data.features[i-1].properties.mag + '**</td><td>' + data.features[i-1].geometry.coordinates[0] + ',' +data.features[i-1].geometry.coordinates[1] + '**</td><td>' + data.features[i-1].properties.time + '**</td><td>' + '<a href="Mapa.php?Lat=' + data.features[i-1].geometry.coordinates[1] + '&Long=' + data.features[i-1].geometry.coordinates[0] + '"><i class="fa fa-area-chart"></i>Ver</a>**</td></tr>';

          if(ultimos_eventos == data.metadata.count){            
            console.log('ultimo: ' + ultimos_eventos);
            console.log('nuevo: ' + data.metadata.count);
            console.log('No hay Sismos');
            console.log('-----------------------------------------------');
          }
          else{
            console.log('SISMOOOOO!!!!!!');
            console.log('***********************************************');

            var diferencia = data.metadata.count - ultimos_eventos;

            for (var i = 1; i <= diferencia; i++){
              Notificacion_Evento('Sismoooo!!!!',data.features[i-1].geometry.coordinates[1],data.features[i-1].geometry.coordinates[0]);
            $('#dataTable tr:first').after('<tr><td>' + data.features[i-1].properties.place +'--'+ data.metadata.count + '</td><td>' + data.features[i-1].properties.mag + '</td><td>' + data.features[i-1].geometry.coordinates[0] + ',' +data.features[i-1].geometry.coordinates[1] + '</td><td>' + data.features[i-1].properties.time + '</td><td>' + '<a href="Mapa.php?Lat=' + data.features[i-1].geometry.coordinates[1] + '&Long=' + data.features[i-1].geometry.coordinates[0] + '"><i class="fa fa-area-chart"></i>Ver</a></td></tr>');
            }
          }

          ultimos_eventos = data.metadata.count;
        }
      });

      /*$.ajax({
        dataType: 'json',
        url: "http://buendiagt.com/acel/json.json",
        success: function(data){
          var j = '[{ "name":"John", "age":30, "city":"New York"}]';
          var types = JSON.parse(data[0]);
          document.getElementById("json").innerHTML = "";
          document.getElementById("json").innerHTML = types.mac;

        }
      });*/

    };

  </script>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <script src="js/Login_Facebook.js"></script> <!-- Libreria Facebook Login -->
  <script>startApp();</script> 

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
        <li class="breadcrumb-item active">Ultimos Eventos</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Sismos Registrados <?php echo date("d-M-Y H:i:s");?>
          <a href="#" onclick="Notificacion_Evento('Holaaa','15.081','-94.0265');">Evento</a>
          <h3><p id="hora"></p></h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <?php 
              $tabla = include 'Tabla.php';
              echo $tabla;
            ?>
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
        <div id="json"></div>
        <?php 
          echo "PHP Versión: " . phpversion();
        ?>
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
