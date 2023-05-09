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
                            <a href="<?php echo site_url('admin/mahasiswa') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/addmahasiswa'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                                <div class="form-group row">
                                    <label for="nip" class="col-sm-2 col-form-label">User ID</label>
                                    <div class="col-sm-4">
                                        <select name="id_user" id="id_user" class="form-control">
                                            <option value="">User ID</option>
                                            <?php foreach ($tuser as $tu) : ?>
                                                <option value="<?= $tu['id_user']; ?>"><?= $tu['username']; ?></option>
                                            <?php endforeach; ?>
                                            <?= form_error('id_user', '<small class="text-danger pl-3">', '</small>'); ?></small>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Tempat" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" name="tanggal_lahir">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <textarea type="text" class="form-control" name="alamat" placeholder="Alamat"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="no_telp" class="col-sm-2 col-form-label">No. Telpon</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="no_telp" placeholder="No. Telpon">
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