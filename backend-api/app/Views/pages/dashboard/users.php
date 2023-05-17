<?= $this->extend('layout/DashboardLayout') ?>

<?= $this->section('content') ?>  

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Data <?= $title ?></h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Add <?= $title ?></button>
                  </div>
                  <?= $this->include('pages/partials/modal_user') ?>
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
                            <button onclick="deleteData(<?= $data['id'] ?>)" class="btn btn-danger">Hapus</button>
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
<?= $this->section('script') ?>
<script src="<?= base_url('js/User.js') ?>"></script>
<?= $this->endSection() ?>