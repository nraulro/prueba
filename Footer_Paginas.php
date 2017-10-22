<?php

$Footer = 
'<footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © SismoGT</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Fin Scroll to Top Button-->
    <!-- Login - Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrate</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="exampleInputEmail1">Correo Electronico</label>
                  <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="ejemplo@dominio.com">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nombre Completo</label>
                  <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Nombre Completo">
                </div>                
                <div class="form-group">
                  <label for="exampleInputPassword1">Contraseña</label>
                  <input class="form-control" id="exampleInputPassword1" type="Password" placeholder="Contraseña">
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox"> Recordar Contraseña</label>
                  </div>
                </div>
                <a class="btn btn-primary btn-block" href="index.html">Registrarse</a>
                <br />
                <div class="form-group">                  
                  <div id="customBtn" class="customGPlusSignIn">
                    <span class="icon"></span>
                    <span class="buttonText">Registrate con Google</span>                    
                  </div>
                  <div id="name"></div>
                  <div id="mail"></div>
                  <div id="ID"></div>
                  <div id="Foto"></div>
                  <a href="#" onclick="signOut();">Cerrar Sesion</a>
                </div>
                <fb:login-button class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email" onlogin="checkLoginState();">
                </fb:login-button>
                <br>                
                <a href="#" onclick="CerrarFace();">Cerrar Sesion FB</a>
                <div id="status">
                </div>                    
              </form>
        <div class="text-center">
          <!-- <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
        </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>            
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Iniciar Sesión</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form>
                <div class="form-group">
                  <label for="exampleInputEmail1">Correo Electronico</label>
                  <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="ejemplo@dominio.com">
                </div>                               
                <div class="form-group">
                  <label for="exampleInputPassword1">Contraseña</label>
                  <input class="form-control" id="exampleInputPassword1" type="Password" placeholder="Contraseña">
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox"> Recordar Contraseña</label>
                  </div>
                </div>
                <a class="btn btn-primary btn-block" href="index.html">Ingresar</a>
                <br />
                <div class="form-group">                  
                  <div id="customBtn" class="customGPlusSignIn">
                    <span class="icon"></span>
                    <span class="buttonText">Iniciar Sesión con Google</span>
                    <a href="#" onclick="signOut();">Cerrar Sesion</a>
                  </div>
                </div>
                <fb:login-button class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email" onlogin="checkLoginState();">
                </fb:login-button>
                <br>                
                <a href="#" onclick="CerrarFace();">Cerrar Sesion FB</a>
                <div id="status2">
                </div>             
            </form>

          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="login.html">Ingresar</a>
          </div>
        </div>
      </div>
    </div>';

if(isset($_SESSION['Tipo_Lg'])){

$Footer .='
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">¿Cerrar Sesión?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Gracias por visitarnos, !Esperamos Verte Pronto</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>';

$Tipo_Login = $_SESSION['Tipo_Lg'];
 if($Tipo_Login == "fb"){
    $Footer .= "<a href='#' class='btn btn-primary' onclick='CerrarFace();'>Cerrar Sesion FB</a>";
 }
 else if($Tipo_Login == "gl"){
    $Footer .= "<a href='#' class='btn btn-primary' onclick='signOut();'>Cerrar Sesion Google</a>"; 
 }

$Footer .= '<!-- <a class="btn btn-primary" onclick="CerrarFace();">Salir FB</a>
            <a class="btn btn-primary" onclick="signOut();">Salir GL</a>-->         
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Login - Logout Modal-->';

}
else{
	$Footer .= '<!-- Fin Login - Logout Modal-->';
}

$Footer .= '
<!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    ';

 return $Footer;

?>