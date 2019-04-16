<?php

require_once "../class/clases.php";

$obj1= new Trabajo();
$cia = $obj1->get_element('dcia','idcia'); 

?>



	<table class="table table-hover table-striped table-bordered display responsive nowrap" id="iddatatable" style="width:100%">
		<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
			<tr>
				<th>Nombre</th>
                <th>Preferencial</th>
				<th>Fecha Desde Preferencial</th>
				<th>Fecha Hasta Preferencial</th>
                <th>Preferencial</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Nombre</th>
                <th>Preferencial</th>
				<th>Fecha Desde Preferencial</th>
				<th>Fecha Hasta Preferencial</th>
                <th>Preferencial</th>
			</tr>
		</tfoot>
		<tbody >
			<?php
			for ($i=0; $i < sizeof($cia); $i++) { 
				
				?>
				<tr >
	                <td><?php echo $cia[$i]['nomcia']; ?></td>
	                <td><?php if ($cia[$i]['preferencial']==0) {
						echo "No";
					} else {
						echo "Sí";
					}
					?></td>
					<td><?php echo $cia[$i]['f_desde_pref']; ?></td>
					<td><?php echo $cia[$i]['f_hasta_pref']; ?></td>
					<td style="text-align: center;">
	                    <a data-tooltip="tooltip" data-placement="top" title="Añadir Preferencial" href="comp_pref.php?nomcia=<?php echo $cia[$i]['nomcia'];?>" class="btn btn-success btn-sm btn-round"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
	                </td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>


<script type="text/javascript">
	$(document).ready(function() {
		$('#iddatatable').DataTable({
			scrollX: 300
		});
	} );

	$(function () {
      $('[data-tooltip="tooltip"]').tooltip()
    })


</script>