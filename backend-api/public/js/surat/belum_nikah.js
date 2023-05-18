const variableModel = 'Surat Keterangan Belum Menikah'
function edit(id) {
    save_method = 'update';
    $('#form')[0].reset(); 
    $.ajax({
        url: `${base_url}${apiUrl}keterangan-belum-menikah/${id}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond) {
            const {  } = respond.data;
            $('#id').val(id);

            $('#modal').modal('show');
            $('.modal-title').text(`Edit ${variableModel}`); 
        },
        error: function(textStatus) {
            alert(textStatus);
        }
    });
}

function save() {
    const id = $('#id').val();
    const url = id ? `${base_url}${apiUrl}keterangan-belum-menikah/${id}` : `${base_url}${apiUrl}keterangan-belum-menikah`;
  
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
            url: `${base_url}${apiUrl}keterangan-belum-menikah/delete/${id}`,
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
