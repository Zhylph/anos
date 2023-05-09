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
        			<a href="<?= base_url('admin/adddetail'); ?>" class="btn btn-facebook mb-3" data-toggle="" data-target=""><i class="fas fa-fw fa-plus"></i></a>
        		</div> 
        		<div class="card-body">
        			<table width="100%" class="table table-striped table-bordered" id="tabeldata">
        				<thead>
        					<tr>
        						<th>#</th>
        						<th>ID Mahasiswa</th>
        						<th>Nama Mahasiswa</th>
        						<th>Nama Kelas</th>
        						<th>Action</th>
        					</tr>
        				</thead>
        				<tbody>
        					<?php $i = 1; ?>
        					<?php foreach ($sdetail as $sd) : ?>
        						<tr>
        							<th scope="row">
        								<?= $i; ?>
        							</th>
									<td>
        								<?= $sd['user_id']; ?>
        							</td>
        							<td>
        								<?= $sd['nama_lengkap']; ?>
        							</td>
        							<td>
        								<?= $sd['nama_kelas']; ?>
        							</td>
        							<td>
        								<a href="<?php echo site_url('admin/editdetail/' . $sd['id']) ?>" class="btn btn-small"><i class="fas fa-edit"></i> </a>
        								<a onclick="deleteConfirm('<?php echo site_url('admin/deletedetail/' . $sd['id']) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> </a>
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