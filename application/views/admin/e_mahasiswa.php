        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Edit Data User</h1>

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
                            <a href="<?php echo site_url('admin/mahasiswa') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/editmahasiswa'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                                <input type="hidden" name="id" value="<?php echo $mhs->id ?>" readonly />
                                <input type="hidden" name="user_id" value="<?php echo $mhs->user_id ?>" readonly />

                                <div class="form-group row">
                                    <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-4">
                                    <input class="form-control <?php echo form_error('nama_lengkap') ? 'is-invalid' : '' ?>" type="text" name="nama_lengkap" value="<?php echo $mhs->nama_lengkap ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('nama_lengkap') ?>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-4">
                                    <input class="form-control <?php echo form_error('tempat_lahir') ? 'is-invalid' : '' ?>" type="text" name="tempat_lahir" value="<?php echo $mhs->tempat_lahir ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('tempat_lahir') ?>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-4">
                                        <input class="form-control <?php echo form_error('tanggal_lahir') ? 'is-invalid' : '' ?>" type="date" name="tanggal_lahir" value="<?php echo $smasuk->tanggal_lahir ?>" />
                                    </div>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('tanggal_lahir') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-4">
                                    <input class="form-control <?php echo form_error('alamat') ? 'is-invalid' : '' ?>" type="text" name="alamat" value="<?php echo $mhs->alamat ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('alamat') ?>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="no_telp" class="col-sm-2 col-form-label">No. Telpon</label>
                                    <div class="col-sm-4">
                                    <input class="form-control <?php echo form_error('no_telp') ? 'is-invalid' : '' ?>" type="text" name="no_telp" value="<?php echo $mhs->no_telp ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('no_telp') ?>
                                    </div>
                                    </div>
                                </div>
                                <input class="btn btn-facebook" type="submit" name="btn" value="Save" />
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
        </div>
        <!-- End of Main Content -->