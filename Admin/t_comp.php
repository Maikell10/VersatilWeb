<?php

require_once "../class/clases.php";

$obj1= new Trabajo();
$cia = $obj1->get_element('dcia','nomcia'); 

?>



	<table class="table table-hover table-striped table-bordered display responsive nowrap" id="iddatatable" style="width:100%">
		<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
			<tr>
				<th>Nombre</th>
				<th hidden>id</th>
                <th>Preferencial</th>
				<th>F Desde Preferencial (Última)</th>
				<th>F Hasta Preferencial (Última)</th>
                <th>Preferencial</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Nombre</th>
				<th hidden>id</th>
                <th>Preferencial</th>
				<th>F Desde Preferencial (Última)</th>
				<th>F Hasta Preferencial (Última)</th>
                <th>Preferencial</th>
			</tr>
		</tfoot>
		<tbody >
			<?php
			for ($i=0; $i < sizeof($cia); $i++) { 

				$obj2= new Trabajo();
				$desde_pref = $obj2->get_f_cia_pref('f_desde_pref',$cia[$i]['idcia']);

				$obj3= new Trabajo();
				$hasta_pref = $obj3->get_f_cia_pref('f_hasta_pref',$cia[$i]['idcia']);

				$desde_prefn = date("d/m/Y", strtotime($desde_pref[0]['f_desde_pref']));
				$hasta_prefn = date("d/m/Y", strtotime($hasta_pref[0]['f_hasta_pref']));

				if ($desde_prefn == '01/01/1970') {
					$desde_prefn=null;
					$hasta_prefn=null;
				}
				
				?>
				<tr style="cursor:pointer">
					<td><?php echo utf8_encode($cia[$i]['nomcia']); ?></td>
					<td hidden><?php echo $cia[$i]['idcia']; ?></td>
	                <td><?php if ($desde_pref[0]['f_desde_pref']==0) {
						echo "No";
					} else {
						echo "Sí";
					}
					?></td>
					<td><?php echo $desde_prefn; ?></td>
					<td><?php echo $hasta_prefn; ?></td>
					<td style="text-align: center;">
	                    <a data-tooltip="tooltip" data-placement="top" title="Añadir Preferencial" href="comp_pref.php?nomcia=<?php echo $cia[$i]['nomcia'];?>" class="btn btn-info btn-sm btn-round"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a>
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
	});
	

	$( "#iddatatable tbody tr" ).dblclick(function() {
		var customerId = $(this).find("td").eq(1).html();   

		window.open ("v_cia.php?id_cia="+customerId ,'_blank');
	});


</script>