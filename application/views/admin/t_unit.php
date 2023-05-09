        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tambah Nama Unit</h1>

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
                            <a href="<?php echo site_url('admin/unit') ?>"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/addunit'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                       
                        <div class="form-group row">
                            <label for="nama_unit" class="col-sm-2 col-form-label">Nama Unit</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_unit" placeholder="Masukkan nama unit..."></input>
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