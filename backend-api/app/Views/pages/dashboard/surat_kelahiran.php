<?= $this->extend('layout/DashboardLayout') ?>

<?= $this->section('content') ?>  

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Data <?= $title ?></h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Add <?= $title ?></button>
                    </div>
                    <?= $this->include('pages/partials/modal_kelahiran') ?>
                  <div class="table-responsive">
                    <table class="table table-striped" id="data">
                      <thead>
                        <tr>
                          <th>Author</th>
                          <th>Nama Lengkap</th>
                          <th>Jenis Kelamin</th>
                          <th>Dilahirkan Di</th>
                          <th>Kelahiran Ke</th>
                          <th>Anak Ke</th>
                          <th>Penolong Kelahiran</th>
                          <th>Alamat Anak</th>
                          <th>NIK</th>
                          <th>Status TTD</th>
                          <th>Disposisi Surat</th>
                          <th>Catatan</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($content as $data): ?>
                        <tr>
                          <td><?= $data['author'] ?></td>
                          <td><?= $data['nama_lengkap'] ?></td>
                          <td><?= $data['jenis_kelamin'] ?></td>
                          <td><?= $data['dilahirkan_di'] ?></td>
                          <td><?= $data['kelahiran_ke'] ?></td>
                          <td><?= $data['anak_ke'] ?></td>
                          <td><?= $data['penolong_kelahiran'] ?></td>
                          <td><?= $data['alamat_anak'] ?></td>
                          <td><?= $data['nik'] ?></td>
                          <td><?= $data['status_ttd'] ?></td>
                          <td><?= $data['disposisi_surat'] ?></td>
                          <td><?= $data['catatan'] ?></td>
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
<script src="<?= base_url('js/surat/kelahiran.js') ?>"></script>
<?= $this->endSection() ?>