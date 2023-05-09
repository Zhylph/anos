        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tambah Data Penerimaan</h1>

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
                            <a href="<?php echo site_url('admin/penerimaan') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/addpenerimaan'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                        <div class="form-group row">
                                    
                        </div>
                        <div class="form-group row">
                            <label for="id_role" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <select name="id_barang" id="id_barang" class="form-control">
                                    <option value="">Nama Barang</option>
                                        <?php foreach ($Barang as $br) : ?>
                                            <option value="<?= $br['id_barang']; ?>"><?= $br['nama_barang']; ?></option>
                                        <?php endforeach; ?>
                                        <?= form_error('id_barang', '<small class="text-danger pl-3">', '</small>'); ?></small>
                                    </select>
                                    </div>
                                    
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tanggal_penerimaan" placeholder="Masukkan tanggal masuk..."></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Tanggal Pembelian</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tanggal_pembelian" placeholder="Masukkan tanggal beli..."></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Jumlah Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="jumlah_penerimaan" placeholder="Masukkan jumlah barang..."></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Harga Satuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="harga_penerimaan" placeholder="Masukkan harga barang..."></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Nama Toko</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_toko" placeholder="Masukkan nama toko ..."></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Alamat toko</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat_toko" placeholder="Masukkan alamat toko..."></input>
                            </div>
                        </div>  
                        <div class="form-group row">
                                    <label for="bukti_penerimaan" class="col-sm-2 col-form-label">Bukti</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="bukti_penerimaan" name="bukti_penerimaan">
                                            <label class="custom-file-label" for="image">Pilih file</label>
                                            <?= form_error('bukti_penerimaan', '<small class="text-danger pl-3">', '</small>'); ?></small>
                                        </div>
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