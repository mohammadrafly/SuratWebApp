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
                                                <option value="" selected>Select email</option>
                                                <?php foreach($email as $data): ?>
                                                <option value="<?= $data['email'] ?>"><?= $data['email'] ?></option>
                                                <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Enter nama lengkap" oninput="limitInput(this, 255)" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="laki-laki">Laki-Laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dilahirkan_di">Dilahirkan di</label>
                                            <textarea type="text" class="form-control" id="dilahirkan_di" name="dilahirkan_di" placeholder="Enter tempat dilahirkan" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelahiran_ke">Kelahiran Ke</label>
                                            <input type="text" class="form-control" id="kelahiran_ke" name="kelahiran_ke" placeholder="Kedua" oninput="limitInput(this, 10)" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="anak_ke">Anak Ke</label>
                                            <input type="text" class="form-control" id="anak_ke" name="anak_ke" placeholder="Ketiga" oninput="limitInput(this, 10)" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="penolong_kelahiran">Penolong Kelahiran</label>
                                            <input type="text" class="form-control" id="penolong_kelahiran" name="penolong_kelahiran" placeholder="Enter penolong kelahiran" oninput="limitInput(this, 255)" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_anak">Alamat Anak</label>
                                            <textarea type="text" class="form-control" id="alamat_anak" name="alamat_anak" placeholder="Enter alamat anak" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="number" class="form-control" id="nik" name="nik" placeholder="3151XXXXXXXXXXX" oninput="limitInput(this, 16)" required>
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
                                            <select class="form-control" id="disposisi_surat" name="disposisi_surat">
                                                <option value="antrian">Antrian</option>
                                                <option value="proses">Proses</option>
                                                <option value="persetujuan">Persetujuan</option>
                                                <option value="selesai">Selesai</option>
                                                <option value="ditolak">Ditolak</option>
                                            </select>
                                        </div>
                                        <div class="form-group">Catatan</label>
                                            <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Enter disposisi surat">
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