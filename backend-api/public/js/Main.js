const base_url = 'http://localhost:8080/';

function signOut() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to sign out?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, I Want to Sign Out!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url:`${base_url}sign-out`,
                type: 'GET',
                dataType: 'JSON',
                success: function (respond) {
                    swal.fire({
                        icon: respond.icon,
                        title: respond.title,
                        text: respond.text,
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000
                    }).then (function() {
                        window.location.href = `${base_url}`;
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal.hideLoading();
                    swal.fire("!Opps ", "Something went wrong, try again later", "error");
                }
            });
        };
    });
}

function simpan() {
    const id = $('#id').val();
    const url = id ? `${base_url}dashboard/users/update/${id}` : `${base_url}dashboard/users`;
    const email = $('#email').val();
    const name = $('#name').val();
    const role = $('#role').val();
    const password = $('#password').val();
  
    $.ajax({
      url: url,
      type: 'POST',
      data: { email, name, role, password },
      success: function(response) {
        if (response.status) {
            Swal.fire({
                icon: response.icon,
                title: response.title,
                text: response.text,
                timer: 3000,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'terjadi error',
            timer: 3000,
            showConfirmButton: false
          }).then(() => {
            location.reload();
        });
        }
      },
      error: function(xhr, status, error) {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Terjadi kesalahan saat menambahkan data user',
        }).then(() => {
            location.reload();
        });
      }
    });
  }
  
function hapus(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: 'You will not be able to recover this user!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'GET',
          url: `${base_url}dashboard/users/delete/${id}`,
          success: function(response) {
            Swal.fire({
              icon: response.icon,
              title: response.title,
              text: response.text,
              timer: 3000,
              showConfirmButton: false
            }).then(() => location.reload());
          },
          error: function() {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong!'
            });
          }
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: 'Cancelled',
          text: 'User is safe :)',
          icon: 'info',
          timer: 3000,
          showConfirmButton: false
        });
      }
    });
}
  
function edit(id) {
    $.ajax({
        url: `${base_url}dashboard/users/update/${id}`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#email').val(response.data.email);
            $('#name').val(response.data.name);
            $('#role').val(response.data.role);
            if (id) {
                $('#password-input').css('display', 'none');
            } else {
                $('#password-input').css('display', 'block');
            }
            $('#id').val(response.data.id);
            $('#myModal').modal('show');
            $('#myModal').on('hidden.bs.modal', function () {
                location.reload();
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}