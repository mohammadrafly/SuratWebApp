// Use arrow function instead of document ready shorthand
$(function() {
    const signInForm = $("#SignIn");
  
    // Use submit event instead of click so that pressing Enter on inputs can submit the form
    signInForm.on("submit", function (event) {
      event.preventDefault();
  
      const emailInput = $('input[name="email"]');
      const passwordInput = $('input[name="password"]');
  
      // Use .val().trim() to check if input is empty
      if (!emailInput.val().trim()) {
        showErrorAlert({
          icon: 'error',
          title: 'Oops!',
          text: 'Email tidak boleh kosong.'
        });
      } else if (!passwordInput.val().trim()) {
        showErrorAlert({
          icon: 'error',
          title: 'Oops!',
          text: 'Password tidak boleh kosong.'
        });
      } else {
        // Use object shorthand syntax and remove unnecessary dataType
        $.ajax({
          url: `${base_url}sign-in`,
          type: "POST",
          data: {
            email: emailInput.val(),
            password: passwordInput.val()
          }
        })
        .done(function(respond) { // Use done instead of success
          console.log(respond);
          if (respond.status === true) {
            showSuccessAlert(respond);
             // Move this out of .then()
          } else {
            showErrorAlert(respond);
          }
        })
        // Combine error alert text with textStatus for more informative error message
        .fail(function(jqXHR, textStatus, errorThrown) {
          showErrorAlert(`Error ${errorThrown}: ${textStatus}. Silahkan hubungi admin.`);
        });
      }
    });
  
    function showSuccessAlert(alertOptions) {
      Swal.fire({
        icon: alertOptions.icon,
        title: alertOptions.title,
        text: alertOptions.text,
        timer: 3000,
        showCancelButton: false,
        showConfirmButton: false,
        allowOutsideClick: false
      }).then(
        window.location.href = `${base_url}dashboard`
      );
    }
  
    // Use default parameter values to provide defaults for optional parameters
    function showErrorAlert(respond) {
      Swal.fire({
        icon: respond.icon,
        title: respond.title,
        text: respond.text
      });
    }
  });
  
//SignUp
$(function() {
  const signInForm = $("#SignUp");

  // Use submit event instead of click so that pressing Enter on inputs can submit the form
  signInForm.on("submit", function (event) {
    event.preventDefault();

    const nameInput = $('input[name="name"]');
    const emailInput = $('input[name="email"]');
    const passwordInput = $('input[name="password"]');
    const passwordConfirmationInput = $('input[name="password_confirmation"]');

    // Use .val().trim() to check if input is empty
    if (!emailInput.val().trim()) {
      showErrorAlert({
        icon: 'error',
        title: 'Oops!',
        text: 'Email tidak boleh kosong.'
      });
    } else if (!passwordInput.val().trim()) {
      showErrorAlert({
        icon: 'error',
        title: 'Oops!',
        text: 'Password tidak boleh kosong.'
      });
    } else if (!nameInput.val().trim()) {
      showErrorAlert({
        icon: 'error',
        title: 'Oops!',
        text: 'Nama tidak boleh kosong.'
      });
    } else if (passwordInput.val().trim() != passwordConfirmationInput.val().trim()) {
      showErrorAlert({
        icon: 'error',
        title: 'Oops!',
        text: 'Password tidak sama.'
      });
    } else {
      // Use object shorthand syntax and remove unnecessary dataType
      $.ajax({
        url: `${base_url}sign-up`,
        type: "POST",
        data: {
          name: nameInput.val(),
          email: emailInput.val(),
          password: passwordInput.val()
        }
      })
      .done(function(respond) { // Use done instead of success
        console.log(respond);
        if (respond.status === true) {
          showSuccessAlert(respond);
           // Move this out of .then()
        } else {
          showErrorAlert(respond);
        }
      })
      // Combine error alert text with textStatus for more informative error message
      .fail(function(jqXHR, textStatus, errorThrown) {
        showErrorAlert(`Error ${errorThrown}: ${textStatus}. Silahkan hubungi admin.`);
      });
    }
  });

  function showSuccessAlert(alertOptions) {
    Swal.fire({
      icon: alertOptions.icon,
      title: alertOptions.title,
      text: alertOptions.text,
      timer: 3000,
      showCancelButton: false,
      showConfirmButton: false,
      allowOutsideClick: false
    }).then(
      window.location.href = `${base_url}sign-up`
    );
  }

  // Use default parameter values to provide defaults for optional parameters
  function showErrorAlert(respond) {
    Swal.fire({
      icon: respond.icon,
      title: respond.title,
      text: respond.text
    });
  }
});
