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
        			<a href="<?= base_url('admin/addsurat'); ?>" class="btn btn-primary mb-3" data-toggle="" data-target=""><i class="fas fa-fw fa-plus"></i></a>
        		</div>
        		<div class="card-body">
				<div class="table-responsive">
        			<table width="100%" class="table table-striped table-bordered table-sm" id="tabeldata">
						<thead>
        					<tr>
        						<th>#</th>
        						<th>Nomor Surat</th>
        						<th>Kode Klasifikasi</th>
        						<th>Unit Pengolah</th>
        						<th>Uraian</th>
        						<th>Tanggal Surat</th>
        						<th>Keterangan</th>
        						<th>Action</th>
        					</tr>
        				</thead>
        				<tbody>
							
        					<?php $i = 1; 
							$bulan_romawi = array(
								'01' => 'I',
								'02' => 'II',
								'03' => 'III',
								'04' => 'IV',
								'05' => 'V',
								'06' => 'VI',
								'07' => 'VII',
								'08' => 'VIII',
								'09' => 'IX',
								'10' => 'X',
								'11' => 'XI',
								'12' => 'XII'
							);?>
							
        					<?php foreach ($skeluar as $sk) : ?>
        						<tr>
        							<th scope="row">
        								<?= $i; ?>
        							</th>
        							<td>
									<?= $sk['nama_klasifikasi'] .'/'. $sk['nomor_surat'] . '-' .  $sk['nama_unit'] .'/RSUD/' . str_replace(array_keys($bulan_romawi), array_values($bulan_romawi), $sk['bulan']. '/' .date('y')); ?>
        							<td>
        								<?= $sk['nama_klasifikasi']; ?>
									</td>
									<td>
        								<?= $sk['nama_unit']; ?>
									</td>
									<td>
        								<?= $sk['uraian']; ?>
									</td>
        							<td>
										<?= date('d F Y', strtotime($sk['tanggal_dipakai'])); ?>
        							</td>
									<td>
										<?= $sk['keterangan']; ?>
									</td>
        							<td>
										<a href="<?= base_url('upload/berkas/' . $sk['file_surat']) ?>" target="_blank" class="btn btn-small"><i class="fas fa-download"></i> </a>
										<a href="<?php echo site_url('admin/editsurat/' . $sk['id_surat']) ?>" class="btn btn-small"><i class="fas fa-edit"></i> </a>
        								<a onclick="deleteConfirm('<?php echo site_url('admin/deletesurat/' . $sk['id_surat']) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> </a>
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
        </div>