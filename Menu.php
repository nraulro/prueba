<?php

	$Menu = "<nav class='navbar navbar-expand-lg navbar-dark bg-dark fixed-top' id='mainNav'>
    <a class='navbar-brand' href='indexSismo.php'>Sismos DEMO</a>
    <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarResponsive'>
      <ul class='navbar-nav navbar-sidenav' id='exampleAccordion'>
        <li class='nav-item' data-toggle='tooltip' data-placement='right' title='Ultimos Eventos'>
          <a class='nav-link' href='indexSismo.php'>
            <i class='fa fa-fw fa-dashboard'></i>
            <span class='nav-link-text'>Ultimos Eventos</span>
          </a>
        </li>        
        <li class='nav-item' data-toggle='tooltip' data-placement='right' title='Lista de Eventos'>
          <a class='nav-link' href='Historico_Eventos.php'>
            <i class='fa fa-fw fa-table'></i>
            <span class='nav-link-text'>Lista de Eventos</span>
          </a>
        </li>
        <li class='nav-item' data-toggle='tooltip' data-placement='right' title='Lista de Eventos'>
          <a class='nav-link' href='Sismos_APP.php'>
            <i class='fa fa-fw fa-table'></i>
            <span class='nav-link-text'>Lista de Eventos APP</span>
          </a>
        </li>
        <li class='nav-item' data-toggle='tooltip' data-placement='right' title='Estadisticas'>
          <a class='nav-link' href='Graficas.php'>
            <i class='fa fa-fw fa-area-chart'></i>
            <span class='nav-link-text'>Estadisticas</span>
          </a>
        </li>      
        <li class='nav-item' data-toggle='tooltip' data-placement='right' title='Descarga Nuestra APP'>
          <a class='nav-link' href='#'>
            <i class='fa fa-fw fa-link'></i>
            <span class='nav-link-text'>Descarga Nuestra APP</span>
          </a>
        </li>
        <div id='statusnot'></div>
      </ul>
      <ul class='navbar-nav sidenav-toggler'>
        <li class='nav-item'>
          <a class='nav-link text-center' id='sidenavToggler'>
            <i class='fa fa-fw fa-angle-left'></i>
          </a>
        </li>
      </ul>
      <ul class='navbar-nav ml-auto'> <!-- Barra Superior -->
        <li class='nav-item dropdown'> <!-- Mensajes Barra Superior -->
          <a class='nav-link dropdown-toggle mr-lg-2' id='messagesDropdown' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            <i class='fa fa-fw fa-envelope'></i>
            <span class='d-lg-none'>Messages
              <span class='badge badge-pill badge-primary'>12 New</span>
            </span>
            <span class='indicator text-primary d-none d-lg-block'>
              <i class='fa fa-fw fa-circle'></i>
            </span>
          </a>
          <div class='dropdown-menu' aria-labelledby='messagesDropdown'>
            <h6 class='dropdown-header'>New Messages:</h6>
            <div class='dropdown-divider'></div>
            <a class='dropdown-item' href='#'>
              <strong>David Miller</strong>
              <span class='small float-right text-muted'>11:21 AM</span>
              <div class='dropdown-message small'>Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class='dropdown-divider'></div>
            <a class='dropdown-item' href='#'>
              <strong>Jane Smith</strong>
              <span class='small float-right text-muted'>11:21 AM</span>
              <div class='dropdown-message small'>I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class='dropdown-divider'></div>
            <a class='dropdown-item' href='#'>
              <strong>John Doe</strong>
              <span class='small float-right text-muted'>11:21 AM</span>
              <div class='dropdown-message small'>I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class='dropdown-divider'></div>
            <a class='dropdown-item small' href='#'>View all messages</a>
          </div>
        </li>
        ";

        $diferencia = 10;
        $DatetimeFechaActual = new DateTime("now");
		// Restamos dias a la fecha actual
		$DatetimeFechaActual->sub(new DateInterval('P' . $diferencia . 'D'));
		$nuevafecha = $DatetimeFechaActual->format('Y-m-d');

        $json = file_get_contents('https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&starttime='.$nuevafecha.'&minlatitude=7&minlongitude=-99&maxlatitude=16&maxlongitude=-78');

		$obj = json_decode($json);
		$Datos = "";

		for ($i=0; $i <= 2; $i++) { 
		
			$Datos .= "<div class='dropdown-divider'></div>
		            <a class='dropdown-item' href='#'>
		              <span class='text-success'>
		                <strong>
		                  <i class='fa fa-long-arrow-up fa-fw'></i>" . $obj->features[$i]->properties->place . "</strong>
		              </span>
		              <span class='small float-right text-muted'>" . date('d/M/Y H:m:s', substr($obj->features[$i]->properties->time,0,10)) . "</span>
		              <div class='dropdown-message small'>Magnitud: " . $obj->features[$i]->properties->mag . "</div>
		            </a>";
		}

        $Alertas = "<li class='nav-item dropdown'> <!-- Alertas Barra Superior -->
		          <a class='nav-link dropdown-toggle mr-lg-2' id='alertsDropdown' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
		            <i class='fa fa-fw fa-bell'></i>
		            <span class='d-lg-none'>Alerts
		              <span class='badge badge-pill badge-warning'>6 New</span>
		            </span>
		            <span class='indicator text-warning d-none d-lg-block'>
		              <i class='fa fa-fw fa-circle'></i>
		            </span>
		          </a>
		          <div class='dropdown-menu' aria-labelledby='alertsDropdown'>
		            <h6 class='dropdown-header'>Ultimos Sismos:</h6>
		            " . $Datos . "
		            <a class='dropdown-item small' href='indexSismo.php'>Ver Todas las Alertas</a>
		          </div>
		        </li>
            ";

        $Menu .= $Alertas . "
        <li class='nav-item'> <!-- Busqueda Barra Superior -->
          <form class='form-inline my-2 my-lg-0 mr-lg-2'>
            <div class='input-group'>
              <input class='form-control' type='text' placeholder='Search for...'>
              <span class='input-group-btn'>
                <button class='btn btn-primary' type='button'>
                  <i class='fa fa-search'></i>
                </button>
              </span>
            </div>
          </form>
        </li>
        ";

session_start();
//$_SESSION['usuario'] = '123';
//session_destroy();
  if(isset($_SESSION['ID_Usr'])){
    
    $Menu .= "
        <li class='nav-item'> <!-- Salir Barra Superior -->
          <a class='nav-link' data-toggle='modal' data-target='#exampleModal3'>
            <i class='fa fa-fw fa-sign-out'></i>Cerrar Sesion</a>
        </li>
      </ul>
    </div>
  </nav>"; 
  
  }
  else{
    $Menu .= "<li class='nav-item'> <!-- Suscripcion Barra Superior -->
          <a class='nav-link' data-toggle='modal' data-target='#exampleModal'>
            <i class='fa fa-fw fa-sign-out'></i>Suscribirse</a>
        </li>
        <li class='nav-item'> <!-- Iniciar Sesion Barra Superior -->
          <a class='nav-link' data-toggle='modal' data-target='#exampleModal2'>
            <i class='fa fa-fw fa-sign-out'></i>Iniciar Sesion</a>
        </li>
      </ul>
    </div>
  </nav>";  
  }

  return $Menu;

?>