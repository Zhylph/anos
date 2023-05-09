        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Anda yakin ingin menyetujui permintaan ini?</h1>

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
                            <a href="<?php echo site_url('admin/permintaan') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/spermintaan'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                                <input type="hidden" name="id_permintaan" value="<?php echo $Permintaan->id_permintaan ?>" readonly />
                                <input type="hidden" name="id_user" value="<?php echo $Permintaan->id_user ?>" readonly />
                                <input type="hidden" name="id_barang" value="<?php echo $Permintaan->id_barang ?>" readonly />
                                <input type="hidden" name="jumlah_permintaan" value="<?php echo $Permintaan->jumlah_permintaan ?>" readonly />
                                <input type="hidden" name="tanggal_permintaan" value="<?php echo $Permintaan->tanggal_permintaan ?>" readonly />
                                <input type="hidden" name="tanggal_dibutuhkan" value="<?php echo $Permintaan->tanggal_dibutuhkan ?>" readonly />
                                <input type="hidden" name="bukti" value="<?php echo $Permintaan->bukti ?>" readonly />
                                <input type="hidden" name="status_persetujuan" value="disetujui" readonly />
                                <input type="hidden" name="tanggal_persetujuan" value="<?php echo date("Y-m-d") ?>" readonly />

                                <div class="form-group row">
                                    <label for="nama_user" class="col-sm-2 col-form-label">Catatan</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" name="catatan" value="" />
                                    </div>
                                    </div>
                                </div>
                                <input class="btn btn-facebook" type="submit" name="btn" value="Setujui" />
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
        </div>
        <!-- End of Main Content -->