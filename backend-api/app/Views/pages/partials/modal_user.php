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
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Enter nik">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Alamat</label>
                                            <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter alamat"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nomor HP</label>
                                            <input type="number" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="6281XXXXX">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                                <select class="form-control" id="role" name="role">
                                                <option value="admin">Admin</option>
                                                <option value="warga">Warga</option>
                                                <option value="kepala_desa">Kepala Desa</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="password-input">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
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