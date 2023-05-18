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
                                        <div id="step-1">
                                            <h2>Informasi Wali</h2> 
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
                                                <label for="nama_wali">Nama Wali</label>
                                                <input type="text" class="form-control" id="nama_wali" name="nama_wali">
                                            </div>
                                            <div class="form-group">
                                                <label for="nik">NIK</label>
                                                <input type="text" class="form-control" id="nik" name="nik">
                                            </div>
                                            <div class="form-group">
                                                <label for="bin_wali">Bin Wali</label>
                                                <input type="text" class="form-control" id="bin_wali" name="bin_wali">
                                            </div>
                                            <div class="form-group">
                                                <label for="ttl_wali">TTL Wali</label>
                                                <input type="text" class="form-control" id="ttl_wali" name="ttl_wali">
                                            </div>
                                            <div class="form-group">
                                                <label for="pekerjaan_wali">Pekerjaan Wali</label>
                                                <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_wali">Alamat Wali</label>
                                                <input type="text" class="form-control" id="alamat_wali" name="alamat_wali">
                                            </div>
                                            <button type="button" class="btn btn-primary next-step">Next</button>
                                        </div>
                                        <!-- Step 2: Personal Information -->
                                        <div id="step-2" class="hidden">
                                            <h2>Informasi Calon Perempuan</h2>
                                            <div class="form-group">
                                                <label for="calon_perempuan">Calon Perempuan</label>
                                                <input type="text" class="form-control" id="calon_perempuan" name="calon_perempuan">
                                            </div>
                                            <div class="form-group">
                                                <label for="binti_perempuan">Binti Perempuan</label>
                                                <input type="text" class="form-control" id="binti_perempuan" name="binti_perempuan">
                                            </div>
                                            <div class="form-group">
                                                <label for="ttl_perempuan">TTL Perempuan</label>
                                                <input type="text" class="form-control" id="ttl_perempuan" name="ttl_perempuan">
                                            </div>
                                            <div class="form-group">
                                                <label for="agama_perempuan">Agama Perempuan</label>
                                                <input type="text" class="form-control" id="agama_perempuan" name="agama_perempuan">
                                            </div>
                                            <div class="form-group">
                                                <label for="pekerjaan_perempuan">Pekerjaan Perempuan</label>
                                                <input type="text" class="form-control" id="pekerjaan_perempuan" name="pekerjaan_perempuan">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_perempuan">Alamat Perempuan</label>
                                                <input type="text" class="form-control" id="alamat_perempuan" name="alamat_perempuan">
                                            </div>
                                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                            <button type="button" class="btn btn-primary next-step">Next</button>
                                        </div>
                                        <div id="step-2" class="hidden">
                                            <h2>Informasi Calon Laki Laki</h2>
                                            <div class="form-group">
                                                <label for="nama_laki_laki">Nama Laki-laki</label>
                                                <input type="text" class="form-control" id="nama_laki_laki" name="nama_laki_laki">
                                            </div>
                                            <div class="form-group">
                                                <label for="bin_laki_laki">Bin Laki-laki</label>
                                                <input type="text" class="form-control" id="bin_laki_laki" name="bin_laki_laki">
                                            </div>
                                            <div class="form-group">
                                                <label for="ttl_laki_laki">TTL Laki-laki</label>
                                                <input type="text" class="form-control" id="ttl_laki_laki" name="ttl_laki_laki">
                                            </div>
                                            <div class="form-group">
                                                <label for="agama_laki_laki">Agama Laki-laki</label>
                                                <input type="text" class="form-control" id="agama_laki_laki" name="agama_laki_laki">
                                            </div>
                                            <div class="form-group">
                                                <label for="pekerjaan_laki_laki">Pekerjaan Laki-laki</label>
                                                <input type="text" class="form-control" id="pekerjaan_laki_laki" name="pekerjaan_laki_laki">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_laki_laki">Alamat Laki-laki</label>
                                                <input type="text" class="form-control" id="alamat_laki_laki" name="alamat_laki_laki">
                                            </div>

                                            <!-- Add the remaining fields here -->

                                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                            <button type="button" class="btn btn-primary next-step">Next</button>
                                        </div>

                                        <!-- Step 3: Additional Information -->
                                        <div id="step-4" class="hidden">
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
                                                <textarea class="form-control" id="disposisi_surat" name="disposisi_surat"></textarea>
                                            </div>
                                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                            <button type="button" onclick="save()" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>