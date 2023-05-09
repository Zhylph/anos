        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Edit Data Barang</h1>

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
                            <a href="<?php echo site_url('admin/barang') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/editbarang'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                                <input type="hidden" name="id_barang" value="<?php echo $Brg->id_barang ?>" readonly />
                                <div class="form-group row">
                                    <label for="nama_user" class="col-sm-2 col-form-label">Nama Barang</label>
                                    <div class="col-sm-4">
                                        <input class="form-control <?php echo form_error('nama_barang') ? 'is-invalid' : '' ?>" type="text" name="nama_barang" value="<?php echo $Brg->nama_barang ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('nama_barang') ?>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_jenis_barang" class="col-sm-2 col-form-label">Jenis Barang</label>
                                    <div class="col-sm-4">
                                        <select name="id_jenis_barang" id="id_jenis_barang" class="form-control">
                                            <option value="<?php echo $Brg->id_jenis_barang ?> ">Tidak ada perubahan</option>
                                            <?php foreach ($JBarang as $jb) : ?>
                                                <option value="<?= $jb['id_jenis_barang']; ?>"><?= $jb['jenis_barang']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="stok" class="col-sm-2 col-form-label">Stok Barang</label>
                                    <div class="col-sm-4">
                                        <input class="form-control <?php echo form_error('stok') ? 'is-invalid' : '' ?>" type="text" name="stok" value="<?php echo $Brg->stok ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('stok') ?>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="satuan" class="col-sm-2 col-form-label">Satuan Barang</label>
                                    <div class="col-sm-4">
                                        <input class="form-control <?php echo form_error('satuan') ? 'is-invalid' : '' ?>" type="text" name="satuan" value="<?php echo $Brg->satuan ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('satuan') ?>
                                    </div>
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