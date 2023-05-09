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
                            <a href="<?php echo site_url('admin/kelas') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/editkelas'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                                <input type="hidden" name="id" value="<?php echo $kls->id ?>" readonly />

                                <div class="form-group row">
                                    <label for="kode_kelas" class="col-sm-2 col-form-label">Kode Kelas</label>
                                    <div class="col-sm-4">
                                    <input class="form-control <?php echo form_error('kode_kelas') ? 'is-invalid' : '' ?>" type="text" name="kode_kelas" value="<?php echo $kls->kode_kelas ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('kode_kelas') ?>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                                    <div class="col-sm-4">
                                    <input class="form-control <?php echo form_error('nama_kelas') ? 'is-invalid' : '' ?>" type="text" name="nama_kelas" value="<?php echo $kls->nama_kelas ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('nama_kelas') ?>
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