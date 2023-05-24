const variableModel = 'Surat Pengantar Permohonan KTP'
function edit(id) {
    save_method = 'update';
    $('#form')[0].reset(); 
    $.ajax({
        url: `${base_url}${apiUrl}pengantar-permohonan-ktp/${id}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond) {
            const {
                catatan,
                author,
                nama,
                nik,
                alamat,
                kelurahan,
                kecamatan,
                kabupaten,
                jumlah_berkas,
                keterangan,
                status_ttd,
                disposisi_surat
            } = respond;

            $('#id').val(id);
            $('#author').val(author);
            $('#nama').val(nama);
            $('#nik').val(nik);
            $('#alamat').val(alamat);
            $('#kelurahan').val(kelurahan);
            $('#kecamatan').val(kecamatan);
            $('#kabupaten').val(kabupaten);
            $('#jumlah_berkas').val(jumlah_berkas);
            $('#keterangan').val(keterangan);
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
    const url = id ? `${base_url}${apiUrl}pengantar-permohonan-ktp/${id}` : `${base_url}${apiUrl}pengantar-permohonan-ktp`;
  
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
            url: `${base_url}${apiUrl}pengantar-permohonan-ktp/delete/${id}`,
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
