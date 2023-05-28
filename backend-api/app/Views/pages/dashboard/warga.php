<?= $this->extend('layout/DashboardLayout') ?>

<?= $this->section('content') ?>  

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Data <?= $title ?></h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Add <?= $title ?></button>
                  </div>
                  <?= $this->include('pages/partials/modal_warga') ?>
                  <div class="table-responsive">
                    <table class="table" id="data">
                      <thead>
                        <tr>
                          <th>NIK</th>
                          <th>Email</th>
                          <th>Nama</th>
                          <th>Nomor HP</th>
                          <th>Alamat</th>
                          <th>Role</th>
                          <th>Status</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($content as $data): ?>
                        <tr>
                          <td><?= $data['nik'] ?></td>
                          <td><?= $data['email'] ?></td>
                          <td><?= $data['name'] ?></td>
                          <td><?= $data['nomor_hp'] ?></td>
                          <td><?= $data['alamat'] ?></td>
                          <td><?= $data['role'] ?></td>
                          <td>
                            <?php if ($data['status'] == 'unverified'): ?>
                                <span class="badge badge-warning">Unverified</span>
                            <?php elseif ($data['status'] == 'verified'): ?>
                                <span class="badge badge-success">Verified</span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <button onclick="deleteData(<?= $data['id'] ?>)" class="btn btn-danger">Hapus</button>
                            <button onclick="edit(<?= $data['id'] ?>)" class="btn btn-primary">Edit</button>
                            <?php if($data['status'] == 'unverified'): ?>
                            <button onclick="verifikasi(<?= $data['id'] ?>)" class="btn btn-primary">Verification</button>
                            <?php endif ?>
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
<?= $this->section('script') ?>
<script src="<?= base_url('js/User.js') ?>"></script>
<?= $this->endSection() ?>