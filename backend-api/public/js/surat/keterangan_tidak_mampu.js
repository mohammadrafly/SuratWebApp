const variableModel = 'Surat Keterangan Tidak Mampu'
function edit(id) {
    save_method = 'update';
    $('#form')[0].reset(); 
    $.ajax({
        url: `${base_url}${apiUrl}keterangan-tidak-mampu/${id}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond) {
            const { author, nama, nik, ttl, alamat, pekerjaan, status_ttd, disposisi_surat } = respond;
            $('#id').val(id);
            $('#author').val(author);
            $('#nama').val(nama);
            $('#nik').val(nik);
            $('#ttl').val(ttl);
            $('#alamat').val(alamat);
            $('#pekerjaan').val(pekerjaan);
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
    const url = id ? `${base_url}${apiUrl}keterangan-tidak-mampu/${id}` : `${base_url}${apiUrl}pengantar-nikah`;
  
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
}
  
function deleteData(id) {
    if (confirm('Anda yakin ingin melakukan operasi ini?')) {
        $.ajax({
            url: `${base_url}${apiUrl}keterangan-tidak-mampu/delete/${id}`,
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
