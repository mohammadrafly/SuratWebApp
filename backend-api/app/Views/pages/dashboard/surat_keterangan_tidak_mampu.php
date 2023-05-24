<?= $this->extend('layout/DashboardLayout') ?>

<?= $this->section('content') ?>  

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Data <?= $title ?></h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Add <?= $title ?></button>
                    </div>
                    <?= $this->include('pages/partials/modal_keterangan_tidak_mampu') ?>
                  <div class="table-responsive">
                    <table class="table table-striped" id="data">
                      <thead>
                        <tr>
                          <th>Author</th>
                          <th>Nama</th>
                          <th>NIK</th>
                          <th>TTL</th>
                          <th>Alamat</th>
                          <th>Pekerjaan</th>
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
                          <td><?= $data['nama'] ?></td>
                          <td><?= $data['nik'] ?></td>
                          <td><?= $data['ttl'] ?></td>
                          <td><?= $data['alamat'] ?></td>
                          <td><?= $data['pekerjaan'] ?></td>
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
<script src="<?= base_url('js/surat/keterangan_tidak_mampu.js') ?>"></script>
<?= $this->endSection() ?>