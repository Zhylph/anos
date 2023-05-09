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
                            <a href="<?php echo site_url('admin/user') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/edituser'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                                <input type="hidden" name="id_user" value="<?php echo $usr->id_user ?>" readonly />

                                <div class="form-group row">
                                    <label for="nama_user" class="col-sm-2 col-form-label">Nama Pegawai</label>
                                    <div class="col-sm-4">
                                        <input class="form-control <?php echo form_error('nama_user') ? 'is-invalid' : '' ?>" type="text" name="nama_user" value="<?php echo $usr->nama_user ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('nama_user') ?>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bidang" class="col-sm-2 col-form-label">Bidang</label>
                                    <div class="col-sm-4">
                                        <input class="form-control <?php echo form_error('bidang') ? 'is-invalid' : '' ?>" type="text" name="bidang" value="<?php echo $usr->bidang ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('bidang') ?>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-4">
                                        <input class="form-control <?php echo form_error('username') ? 'is-invalid' : '' ?>" type="text" name="username" value="<?php echo $usr->username ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('username') ?>
                                    </div>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label for="kategori" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                    <input type="password" class="form-control form-control-user" name="password"  value="<?php echo $usr->bidang ?> placeholder="Password">
                                    </div>
                                </div>
                                <input type="hidden" name="id_user" value="<?php echo $usr->id_user ?>" readonly />

                                
                                <input type="hidden" name="id_role" value="<?php echo $usr->id_role ?>" readonly />

                                <input class="btn btn-facebook" type="submit" name="btn" value="Save" />
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
        </div>
        <!-- End of Main Content -->