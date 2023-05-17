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
  });
  
  function showAlert(icon, title, text) {
    Swal.fire({ icon, title, text });
  }