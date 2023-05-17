<?= $this->extend('layout/DashboardLayout') ?>

<?= $this->section('content') ?>  

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Data Surat Kelahiran</h4>
                    </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="data">
                      <thead>
                        <tr>
                          <th>Author</th>
                          <th>Nama Lengkap</th>
                          <th>Jenis Kelamin</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($content as $data): ?>
                        <tr>
                          <td><?= $data['author'] ?></td>
                          <td><?= $data['nama_lengkap'] ?></td>
                          <td><?= $data['jenis_kelamin'] ?></td>
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