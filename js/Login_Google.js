var googleUser = {};
      var startApp = function() {
        gapi.load('auth2', function(){
          // Retrieve the singleton for the GoogleAuth library and set up the client.
          auth2 = gapi.auth2.init({
            client_id: '914318966607-rioa6fh9p73guf880asvn505qljllcal.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin',
            // Request scopes in addition to 'profile' and 'email'
            //scope: 'profile,email',
          });
          attachSignin(document.getElementById('customBtn'));
        });
      };

      function attachSignin(element) {
        console.log(element.id);
        auth2.attachClickHandler(element, {},
            function(googleUser) {
              document.getElementById('name').innerText = "Usuario Registrado: " +
                  googleUser.getBasicProfile().getName();
              document.getElementById('mail').innerText = "Mail Registrado: " +
                  googleUser.getBasicProfile().getEmail();
              document.getElementById('ID').innerText = "ID Google: " +
                  googleUser.getBasicProfile().getId();
              document.getElementById('Foto').innerText = "Foto: " +
                  googleUser.getBasicProfile().getImageUrl();
              $.post('login_data.php', { usr: googleUser.getBasicProfile().getId(), unm: googleUser.getBasicProfile().getName(), ueml: googleUser.getBasicProfile().getEmail(), urimg: googleUser.getBasicProfile().getImageUrl(), tipo:'gl' });
              location.reload();
            }, function(error) {
              alert(JSON.stringify(error, undefined, 2));
            });        
      }

      function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
              console.log('Sesion Terminada');
              auth2.disconnect();
              document.getElementById('name').innerText = "Sesion Terminada";
              document.getElementById('mail').innerText = "--";
              document.getElementById('ID').innerText = "--";
              document.getElementById('Foto').innerText = "--";
              $.post('logout.php', { usr: '' });
              location.reload();
            });             
      }