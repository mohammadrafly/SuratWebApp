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
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" oninput="limitInput(this, 50)" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" oninput="limitInput(this, 225)" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">NIK</label>
                                            <input type="number" class="form-control" id="nik" name="nik" placeholder="Enter nik" oninput="limitInput(this, 16)" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Alamat</label>
                                            <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter alamat" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nomor HP</label>
                                            <input type="number" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="6281XXXXX" oninput="limitInput(this, 13)" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" onclick="save()" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form-verifikasi">
                                    <div class="modal-body">
                                        <input id="id" name="id" hidden>
                                        <div class="form-group">
                                            <label for="foto_ktp">Foto KTP</label>
                                            <div class="enlarge" onclick="toggleFullscreen(this)">
                                                <img id="foto_ktp" src="" alt="Image Description" width="200px">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="unverified">Unverified</option>
                                                <option value="verified">Verified</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password Baru</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" onclick="doVerification()" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>