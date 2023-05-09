        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tambah Data User</h1>

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
                    <div class="card-header">
                            <a href="<?php echo site_url('admin/user') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                    <form action="<?= base_url('admin/adduser'); ?>" method="post" enctype="multipart/form-data">
                        <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Nama Pegawai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_user" placeholder="Nama User"></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Bidang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="bidang" placeholder="Bidang"></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-user" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                                    <label for="id_role" class="col-sm-2 col-form-label">Hak Akses</label>
                                    <div class="col-sm-4">
                                        <select name="id_role" id="id_role" class="form-control">
                                            <option value="">Hak Akses</option>
                                            <?php foreach ($user_role as $ur) : ?>
                                                <option value="<?= $ur['id']; ?>"><?= $ur['role']; ?></option>
                                            <?php endforeach; ?>
                                            <?= form_error('id_role', '<small class="text-danger pl-3">', '</small>'); ?></small>
                                        </select>
                                    </div>
                                </div>
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
        <!-- End of Main Content -->