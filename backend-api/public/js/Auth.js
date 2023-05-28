$(document).ready(function() {
    $('#SignIn').submit(function(event) {
        event.preventDefault();
  
        const emailInput = $('#email');
        const passwordInput = $('#password');
  
        const email = emailInput.val();
        const password = passwordInput.val();
    
        if (!email) {
          showAlert('error', 'Input Invalid', 'Email/Email tidak boleh kosong');
          return;
        }
  
        if (!password) {
          showAlert('error', 'Input Invalid', 'Password tidak boleh kosong.');
          return;
        }
  
        $.ajax({
            url: `${base_url}sign-in`,
            type: 'POST',
            data: { email, password },
            dataType: 'JSON',
            success: function(response) {
              console.log(response.role)
                if (response.status) {
                  swal.fire({
                      icon: response.icon,
                      title: response.title,
                      text: response.text,
                      showCancelButton: false,
                      showConfirmButton: false,
                      timer: 3000
                  }).then (function() {
                    window.location.href = `${base_url}dashboard`;
                  });
                } else {
                  showAlert(response.icon, response.title, response.text);
                }
            },
            error: function() {
              showAlert(response.icon, response.title, response.text);
            }
        });
    });
    $('#Verifikasi').submit(function(event) {
        event.preventDefault();
    
        const fotoKtpInput = $('#foto_ktp');
        const emailInput = $('#email');
        const tokenInput = $('#token');

        const token = tokenInput.val();
        const email = emailInput.val();
        const fotoKtp = fotoKtpInput[0].files[0];
    
        const formData = new FormData();
        formData.append('foto_ktp', fotoKtp);
        $.ajax({
            url: `${base_url}verifying/account/${email}/${token}`,
            type: 'POST',
            data: formData,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response.role)
                if (response.status) {
                    swal.fire({
                        icon: response.icon,
                        title: response.title,
                        text: response.text,
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function() {
                        window.location.href = `${base_url}`;
                    });
                } else {
                    showAlert(response.icon, response.title, response.text);
                }
            },
            error: function() {
                showAlert(response.icon, response.title, response.text);
            }
        });
    });
  });
  
  function showAlert(icon, title, text) {
    Swal.fire({ icon, title, text });
  }