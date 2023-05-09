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
                    <a href="<?= base_url('admin/addkelas'); ?>" class="btn btn-facebook mb-3" data-toggle="" data-target=""><i class="fas fa-fw fa-plus"></i></a>
                    </div>
        		<div class="card-body">
                    <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                        <thead>
                            <tr>
        						<th>No</th>
                                <th>Kode Kelas</th>
                                <th>Nama Kelas</th>
        						<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                            <?php foreach ($kelas as $k) : ?>
                                <tr>
                                    <th scope="row">
        								<?= $i; ?>
        							</th>
                                    <td>
                                        <?php echo $k['kode_kelas'] ?>
                                    </td>
                                    <td>
                                        <?php echo $k['nama_kelas'] ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url('admin/editkelas/' . $k['id']) ?>" class="btn btn-small"><i class="fas fa-edit"></i> </a>
                                        <a onclick="deleteConfirm('<?php echo site_url('admin/deletekelas/' . $k['id']) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> </a>
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