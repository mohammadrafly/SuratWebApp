    const variableModel = 'User'
    function edit(id) {
        save_method = 'update';
        $('#form')[0].reset(); 
        $.ajax({
            url: `${base_url}dashboard/users/update/${id}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(respond) {
                const { id, name, role , alamat, nomor_hp, email, password, nik } = respond.data;
                $('#id').val(id);
                $('#name').val(name);
                $('#nik').val(nik);
                $('#role').val(role);
                $('#alamat').val(alamat);
                $('#nomor_hp').val(nomor_hp);
                $('#email').val(email);
                $('#password').val(password);
                $('#modal').modal('show');
                $('.modal-title').text(`Edit ${variableModel}`); 
        
                $('#password, #email').prop('readonly', true);
            },
            error: function(textStatus) {
                alert(textStatus);
            }
        });
    }
  
    function save() {
        const id = $('#id').val();
        const url = id ? `${base_url}dashboard/users/update/${id}` : `${base_url}dashboard/users`;
      
        if (isFormValid()) {
            var formData = $('#form').serialize();
            console.log(formData);
            $.ajax({
                url,
                type: 'POST',
                data: $('#form').serialize(),
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: ({ message }) => {
                  alert(message)
                  location.reload()
                },
                error: () => {
                  alert('An error occurred while processing your request.');
                },
            });
        } else {
            alert('Oops! Sepertinya ada yang terlewat. Mohon pastikan semua input telah diisi.')
        }
    }
      
    function deleteData(id) {
        if (confirm('Anda yakin ingin melakukan operasi ini?')) {
            $.ajax({
                url: `${base_url}dashboard/users/delete/${id}`,
                type: 'GET',
                dataType: 'JSON',
                success: ({ message }) => {
                    alert(message);
                    location.reload();
                },
                error: function(textStatus) {
                alert(textStatus);
                }
            });
        }
    }
  
    $('#modal').on('hidden.bs.modal', function() {
        location.reload();
    });
  