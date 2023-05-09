        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <div class="row">
                <div class="col-lg-12">

                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="card mb-3">
        		    <div class="card-header">
                        <a href="<?= base_url('admin/daftarkelas'); ?>" class="btn btn-info mb-3" data-toggle="" data-target=""><i class="fas fa-fw fa-home"></i></a>
                        <a href="<?= base_url('admin/p_kelas2'); ?>" class="btn btn-info mb-3" data-toggle="" data-target=""><i class="fas fa-fw fa-print"></i></a>
                    </div>
        		    <div class="card-body">
                    <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                        <thead>
                            <tr>
        						<th>No</th>
                                <th>Kode Kelas</th>
                                <th>Nama Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                            <?php foreach ($kelas2 as $k2) : ?>
                                <tr>
                                    <th scope="row">
        								<?= $i; ?>
        							</th>
                                    <td>
                                        <?php echo $k2['kode_kelas'] ?>
                                    </td>
                                    <td>
                                        <?php echo $k2['nama_kelas'] ?>
                                    </td>
                                    <td>
                                        <?php echo $k2['nama_lengkap'] ?>
                                    </td>
                                </tr>
        						<?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>