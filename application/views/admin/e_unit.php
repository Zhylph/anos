        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Edit Nama Unit</h1>

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
                            <form action="<?= site_url('admin/editUnit'); ?>" method="post" enctype="multipart/form-data">
                                <!--form_open_multipart untuk upload foto bawaan CI, harus diarahkan ke controler-->
                                <input type="hidden" name="id_unit" value="<?php echo $Unit->id_unit ?>" readonly />

                                <div class="form-group row">
                                    <label for="unit" class="col-sm-2 col-form-label">Nama Unit</label>
                                    <div class="col-sm-4">
                                        <input class="form-control <?php echo form_error('nama_unit') ? 'is-invalid' : '' ?>" type="text" name="nama_unit" value="<?php echo $Unit->nama_unit ?>"/>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('nama_unit') ?>
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