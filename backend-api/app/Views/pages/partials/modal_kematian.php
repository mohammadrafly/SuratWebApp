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
                                                <select class="form-control select2" id="author" name="author" required>
                                                <option value="">Select email</option>
                                                <?php foreach($email as $data): ?>
                                                <option value="<?= $data['email'] ?>"><?= $data['email'] ?></option>
                                                <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama" oninput="limitInput(this, 255)" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="number" class="form-control" id="nik" name="nik" placeholder="Enter NIK" oninput="limitInput(this, 16)" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="laki-laki">Laki-Laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="ttl">Tempat, Tanggal Lahir</label>
                                            <textarea type="text" class="form-control" id="ttl" name="ttl" placeholder="Enter TTL" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select class="form-control" id="agama" name="agama" required>
                                                <option value="">Select Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_tinggal">Alamat Tinggal</label>
                                            <textarea type="text" class="form-control" id="alamat_tinggal" name="alamat_tinggal" placeholder="Enter alamat tinggal" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_meninggal">Tanggal Meninggal</label>
                                            <input type="date" class="form-control" id="tanggal_meninggal" name="tanggal_meninggal" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_meninggal">Alamat Meninggal</label>
                                            <textarea type="text" class="form-control" id="alamat_meninggal" name="alamat_meninggal" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="meninggal_karena">Meninggal Karena</label>
                                            <textarea type="text" class="form-control" id="meninggal_karena" name="meninggal_karena" required></textarea>
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