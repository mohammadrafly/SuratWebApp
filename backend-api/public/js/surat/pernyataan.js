const variableModel = 'Surat Pernyataan'
function edit(id) {
    save_method = 'update';
    $('#form')[0].reset(); 
    $.ajax({
        url: `${base_url}${apiUrl}pernyataan/${id}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond) {
            const {
                author,
                nama,
                binti,
                ttl,
                kewarganegaraan,
                agama,
                pekerjaan,
                alamat,
                pernyataan,
                status_ttd,
                disposisi_surat
            } = respond;

            $('#id').val(id);
            $('#author').val(author);
            $('#nama').val(nama);
            $('#binti').val(binti);
            $('#ttl').val(ttl);
            $('#kewarganegaraan').val(kewarganegaraan);
            $('#agama').val(agama);
            $('#pekerjaan').val(pekerjaan);
            $('#alamat').val(alamat);
            $('#pernyataan').val(pernyataan);
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
    const url = id ? `${base_url}${apiUrl}pernyataan/${id}` : `${base_url}${apiUrl}pengantar-nikah`;
  
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
            url: `${base_url}${apiUrl}pernyataan/delete/${id}`,
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
