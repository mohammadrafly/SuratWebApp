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
                                            <input type="text" class="form-control" id="nama" name="nama" oninput="limitInput(this, 255)" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="number" class="form-control" id="nik" name="nik" oninput="limitInput(this, 16)" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="ttl">Tempat, Tanggal Lahir</label>
                                            <textarea type="text" class="form-control" id="ttl" name="ttl" placeholder="Enter TTL" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" oninput="limitInput(this, 50)" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="penghasilan">Penghasilan</label>
                                            <input type="number" class="form-control" id="penghasilan" name="penghasilan">
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
                                            <textarea type="text" class="form-control" id="disposisi_surat" name="disposisi_surat" required></textarea>
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