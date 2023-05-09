<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3 col-lg-4">
        <div class="row no-gutters">
            <div class="col-md-2">
            <br>
            <a href="<?= base_url('admin/kelas1'); ?>" class="btn btn-info mb-3" data-toggle="" data-target="">Masuk<i class="fas fa-fw fa-share"></i></a>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">Pemrograman Web</h4>
                    <p class="card-text">MK-IX</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3 col-lg-4">
        <div class="row no-gutters">
            <div class="col-md-2">
            <br>
            <a href="<?= base_url('admin/kelas2'); ?>" class="btn btn-info mb-3" data-toggle="" data-target="">Masuk<i class="fas fa-fw fa-share"></i></a>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">Pemrograman Java</h4>
                    <p class="card-text">MK-X</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3 col-lg-4">
        <div class="row no-gutters">
            <div class="col-md-2">
            <br>
            <a href="<?= base_url('admin/kelas3'); ?>" class="btn btn-info mb-3" data-toggle="" data-target="">Masuk<i class="fas fa-fw fa-share"></i></a>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">Pemrograman Visual</h4>
                    <p class="card-text">MK-IV</p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 