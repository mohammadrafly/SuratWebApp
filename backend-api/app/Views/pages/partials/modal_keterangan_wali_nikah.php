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
                                        <div class="step">
                                            <h2>Informasi Wali</h2> 
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
                                                <label for="nama_wali">Nama</label>
                                                <input type="text" class="form-control" id="nama_wali" name="nama_wali" oninput="limitInput(this, 255)" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nik">NIK</label>
                                                <input type="number" class="form-control" id="nik" name="nik" oninput="limitInput(this, 16)" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="bin_wali">Bin</label>
                                                <input type="text" class="form-control" id="bin_wali" name="bin_wali" oninput="limitInput(this, 50)" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="ttl_wali">Tempat, Tanggal Lahir</label>
                                                <textarea type="text" class="form-control" id="ttl_wali" name="ttl_wali" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="pekerjaan">Pekerjaan</label>
                                                <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" oninput="limitInput(this, 50)" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_wali">Alamat</label>
                                                <textarea type="text" class="form-control" id="alamat_wali" name="alamat_wali" required></textarea>
                                            </div>
                                            <button type="button" class="btn btn-primary next-step">Next</button>
                                        </div>
                                        <!-- Step 2: Personal Information -->
                                        <div class="step hidden">
                                            <h2>Informasi Calon Perempuan</h2>
                                            <div class="form-group">
                                                <label for="calon_perempuan">Nama</label>
                                                <input type="text" class="form-control" id="calon_perempuan" name="calon_perempuan" oninput="limitInput(this, 255)" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="binti_perempuan">Binti</label>
                                                <input type="text" class="form-control" id="binti_perempuan" name="binti_perempuan" oninput="limitInput(this, 255)" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="ttl_perempuan">Tempat, Tanggal Lahir</label>
                                                <textarea type="text" class="form-control" id="ttl_perempuan" name="ttl_perempuan" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="agama">Agama</label>
                                                <select class="form-control" id="agama_perempuan" name="agama_perempuan" required>
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
                                                <label for="pekerjaan_perempuan">Pekerjaan</label>
                                                <input type="text" class="form-control" id="pekerjaan_perempuan" name="pekerjaan_perempuan" oninput="limitInput(this, 50)" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_perempuan">Alamat</label>
                                                <textarea type="text" class="form-control" id="alamat_perempuan" name="alamat_perempuan" required></textarea>
                                            </div>
                                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                            <button type="button" class="btn btn-primary next-step">Next</button>
                                        </div>
                                        <div class="step hidden">
                                            <h2>Informasi Calon Laki Laki</h2>
                                            <div class="form-group">
                                                <label for="nama_laki_laki">Nama</label>
                                                <input type="text" class="form-control" id="nama_laki_laki" name="nama_laki_laki" oninput="limitInput(this, 255)" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="bin_laki_laki">Bin</label>
                                                <input type="text" class="form-control" id="bin_laki_laki" name="bin_laki_laki" oninput="limitInput(this, 50)" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="ttl_laki_laki">Tempat, Tanggal Lahir</label>
                                                <textarea type="text" class="form-control" id="ttl_laki_laki" name="ttl_laki_laki" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Agama</label>
                                                <select class="form-control" id="agama_laki_laki" name="agama_laki_laki" required>
                                                    <option value="">Select Agama</option>
                                                    <option value="islam">Islam</option>
                                                    <option value="kristen">Kristen</option>
                                                    <option value="katolik">Katolik</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="buddha">Buddha</option>
                                                    <option value="konghucu">Konghucu</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="pekerjaan">Pekerjaan</label>
                                                <input type="text" class="form-control" id="pekerjaan_laki_laki" name="pekerjaan_laki_laki" oninput="limitInput(this, 50)" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_tinggal">Alamat</label>
                                                <textarea type="text" class="form-control" id="alamat_laki_laki" name="alamat_laki_laki" required></textarea>
                                            </div>
                                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                            <button type="button" class="btn btn-primary next-step">Next</button>
                                        </div>

                                        <!-- Step 3: Additional Information -->
                                        <div class="step hidden">
                                            <!-- Add the remaining fields here -->
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
                                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                            <button type="button" onclick="save()" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>