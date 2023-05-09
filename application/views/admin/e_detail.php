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
                            <form action="<?= site_url('admin/editdetail'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                                <input type="hidden" name="id" value="<?php echo $dtl->id ?>" readonly />

                                <div class="form-group row">
                                    <label for="user_id" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                                    <div class="col-sm-4">
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option value="">Pilih mahasiswa</option>
                                            <?php foreach ($tmahasiswa as $tm) : ?>
                                                <option value="<?= $tm['user_id']; ?>"><?= $tm['nama_lengkap']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kelas_id" class="col-sm-2 col-form-label">Nama Kelas</label>
                                    <div class="col-sm-4">
                                        <select name="kelas_id" id="kelas_id" class="form-control">
                                            <option value="">Pilih kelas</option>
                                            <?php foreach ($tkelas as $tk) : ?>
                                                <option value="<?= $tk['id']; ?>"><?= $tk['nama_kelas']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
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