const variableModel = 'Surat Keterangan Belum Menikah'
function edit(id) {
    save_method = 'update';
    $('#form')[0].reset(); 
    $.ajax({
        url: `${base_url}${apiUrl}pengantar-nikah/${id}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond) {
            const {
                catatan,
                author,
                nama_wali,
                nik,
                bin_wali,
                ttl_wali,
                pekerjaan_wali,
                alamat_wali,
                calon_perempuan,
                binti_perempuan,
                ttl_perempuan,
                agama_perempuan,
                pekerjaan_perempuan,
                alamat_perempuan,
                nama_laki_laki,
                bin_laki_laki,
                ttl_laki_laki,
                agama_laki_laki,
                pekerjaan_laki_laki,
                alamat_laki_laki,
                status_ttd,
                disposisi_surat
            } = respond;

            $('#id').val(id);
            $('#author').val(author);
            $('#nama_wali').val(nama_wali);
            $('#nik').val(nik);
            $('#bin_wali').val(bin_wali);
            $('#ttl_wali').val(ttl_wali);
            $('#pekerjaan_wali').val(pekerjaan_wali);
            $('#alamat_wali').val(alamat_wali);
            $('#calon_perempuan').val(calon_perempuan);
            $('#binti_perempuan').val(binti_perempuan);
            $('#ttl_perempuan').val(ttl_perempuan);
            $('#agama_perempuan').val(agama_perempuan);
            $('#pekerjaan_perempuan').val(pekerjaan_perempuan);
            $('#alamat_perempuan').val(alamat_perempuan);
            $('#nama_laki_laki').val(nama_laki_laki);
            $('#bin_laki_laki').val(bin_laki_laki);
            $('#ttl_laki_laki').val(ttl_laki_laki);
            $('#agama_laki_laki').val(agama_laki_laki);
            $('#pekerjaan_laki_laki').val(pekerjaan_laki_laki);
            $('#alamat_laki_laki').val(alamat_laki_laki);
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
    const url = id ? `${base_url}${apiUrl}pengantar-nikah/${id}` : `${base_url}${apiUrl}pengantar-nikah`;
  
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
            url: `${base_url}${apiUrl}pengantar-nikah/delete/${id}`,
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
