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
                            <a href="<?php echo site_url('admin/barang') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/addbarang'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                        <div class="form-group row">
                            <label for="id_role" class="col-sm-2 col-form-label">Klasfikasi Barang</label>
                                <div class="col-sm-6">
                                    <select name="id_jenis_barang" id="id_jenis_barang" class="form-control">
                                    <option value="">Klasfikasi Barang</option>
                                        <?php foreach ($JBarang as $jb) : ?>
                                            <option value="<?= $jb['id_jenis_barang']; ?>"><?= $jb['jenis_barang']; ?></option>
                                        <?php endforeach; ?>
                                        <?= form_error('id_jenis_barang', '<small class="text-danger pl-3">', '</small>'); ?></small>
                                    </select>
                                    </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_barang" placeholder="Masukkan nama barang..."></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Stok Barang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="stok" placeholder="Masukkan stok barang..."></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Satuan Barang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="satuan" placeholder="Masukkan satuan barang..."></input>
                            </div>
                        </div>                        
                                <input class="btn btn-success" type="submit" name="btn" value="Simpan" />
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
        </div>
        <!-- End of Main Content -->