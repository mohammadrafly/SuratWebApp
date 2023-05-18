                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form">
                                    <div class="modal-body">
                                        <input id="id" name="id" hidden>
                                        <div class="form-group" id="email-input">
                                            <label for="email">Email</label>
                                            <div>
                                                <select class="form-control select2" id="email" name="email">
                                                    <option value="">Select email</option>
                                                    <?php foreach($email as $data): ?>
                                                    <option value="<?= $data['email'] ?>"><?= $data['email'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama">
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik">
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        </div>
                                        <div class="form-group">
                                            <label for="ttl">Tempat Tanggal Lahir</label>
                                            <input type="text" class="form-control" id="ttl" name="ttl">
                                        </div>
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <input type="text" class="form-control" id="agama" name="agama">
                                        </div>
                                        <div class="form-group">
                                            <label for="status_perkawinan">Status Perkawinan</label>
                                            <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan">
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                                        </div>
                                        <div class="form-group">
                                            <label for="kewarganegaraan">Kewarganegaraan</label>
                                            <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan">
                                        </div>
                                        <div class="form-group">
                                            <label for="status_ttd">Status TTD</label>
                                            <input type="text" class="form-control" id="status_ttd" name="status_ttd">
                                        </div>
                                        <div class="form-group">
                                            <label for="disposisi_surat">Disposisi Surat</label>
                                            <input type="text" class="form-control" id="disposisi_surat" name="disposisi_surat">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" onclick="save()" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>