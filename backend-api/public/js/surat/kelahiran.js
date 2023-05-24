const variableModel = 'Surat Kelahiran'
function edit(id) {
    save_method = 'update';
    $('#form')[0].reset(); 
    $.ajax({
        url: `${base_url}${apiUrl}kelahiran/${id}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond) {
            const { catatan, id, author, nama_lengkap, jenis_kelamin, dilahirkan_di, kelahiran_ke, anak_ke, penolong_kelahiran, alamat_anak, nik, status_ttd, disposisi_surat } = respond;
            $('#id').val(id);
            $('#nama_lengkap').val(nama_lengkap);
            $('#author').val(author);
            $('#jenis_kelamin').val(jenis_kelamin);
            $('#dilahirkan_di').val(dilahirkan_di);
            $('#kelahiran_ke').val(kelahiran_ke);
            $('#anak_ke').val(anak_ke);
            $('#penolong_kelahiran').val(penolong_kelahiran);
            $('#alamat_anak').val(alamat_anak);
            $('#nik').val(nik);
            $('#status_ttd').val(status_ttd);
            $('#disposisi_surat').val(disposisi_surat);
            $('#catatan').val(catatan);
            
            $('#modal').modal('show');
            $('.modal-title').text(`Edit ${variableModel}`); 

            $('#email-input').prop('hidden', true);
        },
        error: function(textStatus) {
            alert(textStatus);
        }
    });
}

function save() {
    const id = $('#id').val();
    const url = id ? `${base_url}${apiUrl}kelahiran/${id}` : `${base_url}${apiUrl}kelahiran`;
  
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
            url: `${base_url}${apiUrl}kelahiran/delete/${id}`,
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
