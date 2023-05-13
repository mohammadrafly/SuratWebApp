<?= $this->extend('layout/DashboardLayout') ?>

<?= $this->section('content') ?>  

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Data User</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add User</button>
                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form">
                                <div class="modal-body">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Enter email">
                                            <input id="id" hidden>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Enter name">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                                <select class="form-control" id="role">
                                                <option value="admin">Admin</option>
                                                <option value="warga">Warga</option>
                                                <option value="kepala_desa">Kepala Desa</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="password-input">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" onclick="simpan()" class="btn btn-primary">Save changes</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="data">
                      <thead>
                        <tr>
                          <th>Email</th>
                          <th>Nama</th>
                          <th>Role</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($content as $data): ?>
                        <tr>
                          <td><?= $data['email'] ?></td>
                          <td><?= $data['name'] ?></td>
                          <td><?= $data['role'] ?></td>
                          <td>
                                <button onclick="hapus(<?= $data['id'] ?>)" class="btn btn-danger">Hapus</button>
                                <button onclick="edit(<?= $data['id'] ?>)" class="btn btn-primary">Edit</button>
                            </td>
                        </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

<?= $this->endSection() ?>