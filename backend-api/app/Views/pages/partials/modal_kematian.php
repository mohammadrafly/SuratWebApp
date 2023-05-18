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
                                                <select class="form-control select2" id="author" name="author">
                                                <option value="">Select email</option>
                                                <?php foreach($email as $data): ?>
                                                <option value="<?= $data['email'] ?>"><?= $data['email'] ?></option>
                                                <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama">
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Enter NIK">
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                <option value="laki-laki">Laki-Laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="ttl">TTL</label>
                                            <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Enter TTL">
                                        </div>
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <input type="text" class="form-control" id="agama" name="agama" placeholder="Enter agama">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_tinggal">Alamat Tinggal</label>
                                            <input type="text" class="form-control" id="alamat_tinggal" name="alamat_tinggal" placeholder="Enter alamat tinggal">
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_meninggal">Tanggal Meninggal</label>
                                            <input type="text" class="form-control" id="tanggal_meninggal" name="tanggal_meninggal" placeholder="Enter tanggal meninggal">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_meninggal">Alamat Meninggal</label>
                                            <input type="text" class="form-control" id="alamat_meninggal" name="alamat_meninggal" placeholder="Enter alamat meninggal">
                                        </div>
                                        <div class="form-group">
                                            <label for="meninggal_karena">Meninggal Karena</label>
                                            <input type="text" class="form-control" id="meninggal_karena" name="meninggal_karena" placeholder="Enter meninggal karena">
                                        </div>
                                        <div class="form-group">
                                            <label for="status_ttd">Status TTD</label>
                                            <select class="form-control" id="status_ttd" name="status_ttd">
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="disposisi_surat">Disposisi Surat</label>
                                            <input type="text" class="form-control" id="disposisi_surat" name="disposisi_surat" placeholder="Enter disposisi surat">
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