<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <?php foreach ($detail as $d) : ?>
        <div class="card mb-3 col-lg-8">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $d['foto']; ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title"><?= $d['nama_lengkap']; ?></h4>
                    <h5 class="card-text">[<?= $d['kode_kelas']; ?>] <?= $d['nama_kelas']; ?></h5>
                    <br>
                    <p class="card-text"><?= $d['alamat']; ?></p>
                    <p class="card-text"><?= $d['tempat_lahir']; ?></p>
                    <p class="card-text"><?= $d['tanggal_lahir']; ?></p>
                    <p class="card-text"><?= $d['no_telp']; ?></p>
                    <p class="card-text"><?= $d['alamat']; ?></p>
                </div>
            </div>
        </div>
    </div>
        					<?php endforeach; ?>
    

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 