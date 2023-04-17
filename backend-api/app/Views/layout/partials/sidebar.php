            <nav class="sidebar">
                <div class="sidebar-header">
                    <a href="#" class="sidebar-brand">
                        Noble<span>UI</span>
                    </a>
                    <div class="sidebar-toggler not-active">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div class="sidebar-body">
                    <ul class="nav">
                        <li class="nav-item nav-category">Main</li>
                        <li class="nav-item">
                            <a href="<?= base_url('dashboard') ?>" class="nav-link">
                                <i class="link-icon" data-feather="box"></i>
                                <span class="link-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item nav-category">Work</li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
                                <i class="link-icon" data-feather="feather"></i>
                                <span class="link-title">Riwayat Surat</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse" id="uiComponents">
                                <ul class="nav sub-menu">
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/surat-kelahiran') ?>" class="nav-link">Surat Kelahiran</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/') ?>" class="nav-link">Surat Kematian</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/') ?>" class="nav-link">Surat Keterangan Belum Menikah</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/') ?>" class="nav-link">Surat Keterangan Penghasilan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/') ?>" class="nav-link">Surat Keterangan Permohonan KTP</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/') ?>" class="nav-link">Surat Keterangan SKCK</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/') ?>" class="nav-link">Surat Keterangan Tidak Mampu</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/') ?>" class="nav-link">Surat Keterangan Wali</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/') ?>" class="nav-link">Surat Pengantar Nikah</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/') ?>" class="nav-link">Surat Pengantar Permohonan KTP</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/') ?>" class="nav-link">Surat Permohonan KK</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('dashboard/') ?>" class="nav-link">Surat Pernyataan</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item nav-category">Data</li>
                        <li class="nav-item">
                            <a href="<?= base_url('dashboard/users') ?>" class="nav-link">
                                <i class="link-icon" data-feather="user"></i>
                                <span class="link-title">Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('dashboard/rpw-request') ?>" class="nav-link">
                                <i class="link-icon" data-feather="user"></i>
                                <span class="link-title">RPW Request</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <nav class="settings-sidebar">
                <div class="sidebar-body">
                    <a href="#" class="settings-sidebar-toggler">
                    <i data-feather="settings"></i>
                    </a>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
                            Light
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
                            Dark
                            </label>
                        </div>
                </div>
            </nav>