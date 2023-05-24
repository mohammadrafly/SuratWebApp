<?= $this->extend('layout/DashboardLayout') ?>

<?= $this->section('content') ?>  

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Data <?= $title ?></h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Add <?= $title ?></button>
                    </div>
                    <?= $this->include('pages/partials/modal_pengantar_nikah') ?>
                  <div class="table-responsive">
                    <table class="table table-striped" id="data">
                      <thead>
                        <tr>
                          <th>Author</th>
                          <th>Nama Wali</th>
                          <th>NIK Wali</th>
                          <th>Bin Wali</th>
                          <th>TTL Wali</th>
                          <th>Pekerjaan Wali</th>
                          <th>Alamat Wali</th>
                          <th>Calon Perempuan</th>
                          <th>Binti Perempuan</th>
                          <th>TTL Perempuan</th>
                          <th>Agama Perempuan</th>
                          <th>Pekerjaan Perempuan</th>
                          <th>Alamat Perempuan</th>
                          <th>Calon Laki Laki</th>
                          <th>Bin Laki Laki</th>
                          <th>TTL Laki Laki</th>
                          <th>Agama Laki Laki</th>
                          <th>Pekerjaan Laki Laki</th>
                          <th>Alamat Laki Laki</th>
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
                            <td><?= $data['nama_wali'] ?></td>
                            <td><?= $data['nik'] ?></td>
                            <td><?= $data['bin_wali'] ?></td>
                            <td><?= $data['ttl_wali'] ?></td>
                            <td><?= $data['pekerjaan_wali'] ?></td>
                            <td><?= $data['alamat_wali'] ?></td>
                            <td><?= $data['calon_perempuan'] ?></td>
                            <td><?= $data['binti_perempuan'] ?></td>
                            <td><?= $data['ttl_perempuan'] ?></td>
                            <td><?= $data['agama_perempuan'] ?></td>
                            <td><?= $data['pekerjaan_perempuan'] ?></td>
                            <td><?= $data['alamat_perempuan'] ?></td>
                            <td><?= $data['nama_laki_laki'] ?></td>
                            <td><?= $data['bin_laki_laki'] ?></td>
                            <td><?= $data['ttl_laki_laki'] ?></td>
                            <td><?= $data['agama_laki_laki'] ?></td>
                            <td><?= $data['pekerjaan_laki_laki'] ?></td>
                            <td><?= $data['alamat_laki_laki'] ?></td>
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
<script src="<?= base_url('js/surat/pengantar_nikah.js') ?>"></script>
<?= $this->endSection() ?>