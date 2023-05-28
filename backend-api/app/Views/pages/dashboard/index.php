<?= $this->extend('layout/DashboardLayout') ?>

<?= $this->section('content') ?>  

                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Halo! <?= session()->get('name') ?></h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6>
                </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Total User</p>
                      <p class="fs-30 mb-2"><?= $total_users ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Surat Kelahiran</p>
                      <p class="fs-30 mb-2"><?= $total_kelahiran ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Surat Kematian</p>
                      <p class="fs-30 mb-2"><?= $total_kematian ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Total Surat Keterangan Belum Nikah</p>
                      <p class="fs-30 mb-2"><?= $total_k_belum_menikah ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Total Surat Keterangan Penghasilan</p>
                      <p class="fs-30 mb-2"><?= $total_k_penghasilan ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Surat Keterangan Permohonan KTP</p>
                      <p class="fs-30 mb-2"><?= $total_k_permohonan_ktp ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Surat SKCK</p>
                      <p class="fs-30 mb-2"><?= $total_skck ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Total Surat Keterangan Tidak Mampu</p>
                      <p class="fs-30 mb-2"><?= $total_tidak_mampu ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Total Surat Keterangan Wali Nikah</p>
                      <p class="fs-30 mb-2"><?= $total_wali_nikah ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Surat Pengantar Nikah</p>
                      <p class="fs-30 mb-2"><?= $total_pengantar_nikah ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Surat Pengantar Permohonan KTP</p>
                      <p class="fs-30 mb-2"><?= $total_p_permohonan_ktp ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Total Surat Penyataan</p>
                      <p class="fs-30 mb-2"><?= $total_pernyataan ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<?= $this->endSection() ?>