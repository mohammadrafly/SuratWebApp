<?= $this->extend('layout/DashboardLayout') ?>

<?= $this->section('content') ?>  

                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Halo! <?= session()->get('name') ?></h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6>
                </div>

<?= $this->endSection() ?>