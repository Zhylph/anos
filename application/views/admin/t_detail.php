        <!-- Begin Page Content -->
        <?php error_reporting(0); ?>
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tambah Data Surat Masuk</h1>

            <div class="row">
                <div class="col-lg-8">

                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <a href="<?php echo site_url('admin/detail') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/adddetail'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                                <div class="form-group row">
                                    <label for="id" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                                    <div class="col-sm-4">
                                        <select name="id_user" id="id_user" class="form-control">
                                            <option value="">Pilih nama mahasiswa..</option>
                                            <?php foreach ($tmahasiswa as $tm) : ?>
                                                <option value="<?= $tm['id_user']; ?>"><?= $tm['nama_lengkap']; ?></option>
                                            <?php endforeach; ?>
                                            <?= form_error('id_user', '<small class="text-danger pl-3">', '</small>'); ?></small>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id" class="col-sm-2 col-form-label">Nama Kelas</label>
                                    <div class="col-sm-4">
                                        <select name="kelas_id" id="kelas_id" class="form-control">
                                            <option value="">Pilih kelas...</option>
                                            <?php foreach ($tkelas as $tk) : ?>
                                                <option value="<?= $tk['id']; ?>"><?= $tk['nama_kelas']; ?></option>
                                            <?php endforeach; ?>
                                            <?= form_error('kelas_id', '<small class="text-danger pl-3">', '</small>'); ?></small>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="class row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
        </div>
        <!-- End of Main Content -->