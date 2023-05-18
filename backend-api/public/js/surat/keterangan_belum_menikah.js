const variableModel = 'Surat Keterangan Belum Menikah'
function edit(id) {
    save_method = 'update';
    $('#form')[0].reset(); 
    $.ajax({
        url: `${base_url}${apiUrl}keterangan-belum-menikah/${id}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond) {
            const { author, nama, nik, jenis_kelamin, ttl, agama, alamat_tinggal, status_perkawinan, pekerjaan, kewarganegaraan, status_ttd, disposisi_surat } = respond.data;
            $('#id').val(id);
            $('#author').val(author);
            $('#nama').val(nama);
            $('#nik').val(nik);
            $('#jenis_kelamin').val(jenis_kelamin);
            $('#ttl').val(ttl);
            $('#agama').val(agama);
            $('#alamat_tinggal').val(alamat_tinggal);
            $('#status_perkawinan').val(status_perkawinan);
            $('#pekerjaan').val(pekerjaan);
            $('#kewarganegaraan').val(kewarganegaraan);
            $('#status_ttd').val(status_ttd);
            $('#disposisi_surat').val(disposisi_surat);

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
