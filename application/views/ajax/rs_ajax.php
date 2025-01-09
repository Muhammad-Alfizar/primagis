<div class="uk-overflow-auto">
	<table class="uk-table uk-table-justify uk-table-divider">
		<thead>
			<tr>
                    <th>NO</th>
					<th>NAMA KECAMATAN</th>
					<th>LOKASI</th>
					<th>NAMA</th>
					<th>LATITUDE</th>
					<th>LONGITUDE</th>
					<th>KATEGORI</th>
					
					<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
        <?php if( ! empty($rs)) {
            ?>
            <?php 
            $no=1;
			foreach($rs as $r){ 
				
			?>
				
				<tr>
					<td width="40px"><?=$no?></td>
					<td><?=$r->kecamatanRs?></td>
					<td><?=$r->lokasiRs?></td>
					<td><?=$r->namaRs?></td>
					<td><?=$r->latitudeRs?></td>
					<td><?=$r->longitudeRs?></td>
					<td><?=$r->kategoriRs?></td>
					<td>
                    <a href="#" class="uk-icon-link uk-margin-small-right" id="formedit" uk-icon="file-edit"
                    data-id="<?=$r->idRs?>"
                    data-kecamatan="<?=$r->kecamatanRs?>"
                    data-lokasi="<?=$r->lokasiRs?>"
                    data-latitude="<?=$r->latitudeRs?>"
                    data-longitude="<?=$r->longitudeRs?>"
                    data-nama="<?=$r->namaRs?>"
                    data-kategori="<?=$r->kategoriRs?>"
					
					></a>
					<a href="#" class="uk-icon-link" uk-icon="trash" id="hapusdata" 
					data-id="<?=$r->idRs?>"
                    data-kecamatan="<?=$r->kecamatanRs?>"></a>
				
					</td>
				</tr>
			<?php $no++; } 
            }else{
            ?>
            <tr><td colspan="9" class="no-records">No records</td></tr>
            <?php } ?>
		</tbody>
	</table>
    
	</div>
    <ul class="uk-pagination" uk-margin-small-right>
    <?php echo $pagelinks?>
    </ul>
    
    
