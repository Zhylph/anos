        <!-- Begin Page Content -->
        <div class="container-fluid">

        	<!-- Page Heading -->
        	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        	<?php if ($this->session->flashdata('success')) : ?>
        		<div class="alert alert-success" role="alert">
        			<?php echo $this->session->flashdata('success'); ?>
        		</div>
        	<?php endif; ?>

        	<div class="card mb-3">
        		<div class="card-header">
        			<a href="<?= base_url('admin/addmahasiswa'); ?>" class="btn btn-facebook mb-3" data-toggle="" data-target=""><i class="fas fa-fw fa-plus"></i></a>
        		</div>
        		<div class="card-body">
        			<table width="100%" class="table table-striped table-bordered" id="tabeldata">
        				<thead>
        					<tr>
        						<th>#</th>
        						<th>User ID</th>
        						<th>Nama Lengkap</th>
        						<th>Tempat Lahir</th>
        						<th>Tanggal Lahir</th>
        						<th>Alamat</th>
        						<th>No. Telpon</th>
        						<th>Action</th>
        					</tr>
        				</thead>
        				<tbody>
        					<?php $i = 1; ?>
        					<?php foreach ($mahasiswa as $mhs) : ?>
        						<tr>
        							<th scope="row">
        								<?= $i; ?>
        							</th>
        							<td>
        								<?= $mhs['user_id']; ?>
        							</td>
        							<td>
        								<?= $mhs['nama_lengkap']; ?>
									</td>
									<td>
        								<?= $mhs['tempat_lahir']; ?>
									</td>
                                    <td>
        								<?= date('d F Y', strtotime($mhs['tanggal_lahir'])); ?>
        							</td>
									<td>
        								<?= $mhs['alamat']; ?>
									</td>
									<td>
        								<?= $mhs['no_telp']; ?>
        							</td>
        							
        							
        							<td>
										<a href="<?php echo site_url('admin/editmahasiswa/' . $mhs['id']) ?>" class="btn btn-small"><i class="fas fa-edit"></i> </a>
        								<a onclick="deleteConfirm('<?php echo site_url('admin/deletemahasiswa/' . $mhs['id']) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> </a>
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