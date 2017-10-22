$(document).ready(function() {
            // Instrucciones a ejecutar al terminar la carga
            if(window.Notification.permission !== 'granted') {
              //alert('Permissions hasnt been granted');
              document.getElementById('statusnot').innerHTML = '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Recibir Notificaciones"> <a class="nav-link" href="#" id="S-Permisos-Not" onclick="PedirPermisos();"><i class="fa fa-fw fa-bell"></i><span class="nav-link-text">Recibir Notificaciones</span></a></li>';
            }
            else{
              document.getElementById('statusnot').innerHTML = '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Notificaciones Activadas"> <a class="nav-link" href="#" id="S-Permisos-Not" onclick="Notificacion_Bienvenida();"><i class="fa fa-fw fa-bell"></i><span class="nav-link-text">Notificaciones Activadas</span></a></li>';
              Notificacion_Bienvenida();
            }        
});

function PedirPermisos(){
          //Notification.requestPermission();
          Notification.requestPermission(function(result) {
            if (result === 'denied') {
              alert('Solicitud de Permisos, Bloqueado');
              return;
            } else if (result === 'default') {
              alert('Solicitud de Permisos, Rechazada');
              return;
            }
            else{
              //new window.Notification('Bienvenido');
              Notificacion_Bienvenida();
              document.getElementById('statusnot').innerHTML = '';
              document.getElementById('statusnot').innerHTML = '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Notificaciones Activadas"> <a class="nav-link" href="#" id="S-Permisos-Not" onclick="Notificacion_Bienvenida();"><i class="fa fa-fw fa-bell"></i><span class="nav-link-text">Notificaciones Activadas</span></a></li>';
            }            
          });         
};

function Notificacion_Bienvenida() {
          if (Notification) {
            if (Notification.permission !== "granted") {
              Notification.requestPermission()
            }
            var title = "SismoGT"
            var extra = {
              icon: "http://www.gmkfreelogos.com/logos/S/img/Sismo_Grafico.gif",
              body: "Bienvenido a SismoGT"
            }
            var noti = new Notification( title, extra)
            noti.onclick = {
              // Al hacer click
            }
            noti.onclose = {
              // Al cerrar
            }
            setTimeout( function() { noti.close() }, 10000)
          }
};

function Notificacion_Evento(Mensaje,Lat,Long) {
          var pagina = "Mapa.php?";
          var url = pagina.concat("Lat=", Lat, "&Long=", Long);

          if (Notification) {
            if (Notification.permission !== "granted") {
              Notification.requestPermission()
            }
            var title = "SismoGT"
            var extra = {
              icon: "http://www.gmkfreelogos.com/logos/S/img/Sismo_Grafico.gif",
              body: Mensaje
            }
            var noti = new Notification( title, extra)
            noti.onclick = function(event) {
              event.preventDefault(); // Previene al buscador de mover el foco a la pestaña del Notification
              window.open(url, '_blank');
              noti.close();
            }
            noti.onclose = {
              // Al cerrar
            }
            setTimeout( function() { noti.close() }, 10000)
          }
};