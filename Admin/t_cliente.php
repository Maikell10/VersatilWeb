<?php
ini_set('max_execution_time', 300);

require_once "../class/clases.php";

$obj1= new Trabajo();
$cliente = $obj1->get_element('titular','id_titular'); 

?>



	<table class="table table-hover table-striped table-bordered display responsive nowrap" id="iddatatable" >
		<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
			<tr>
				<th hidden="">id</th>
				<th hidden="">ci</th>
				<th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cant. Pólizas</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th hidden="">id</th>
				<th hidden="">ci</th>
				<th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cant. Pólizas</th>
			</tr>
		</tfoot>
		<tbody >
			<?php
			for ($i=1; $i < sizeof($cliente); $i++) { 

				$obj2= new Trabajo();
				$clientet = $obj2->get_cliente_total($cliente[$i]['id_titular']); 
				
				?>
				<tr style="cursor: pointer;">
					<td hidden=""><?= $cliente[$i]['id_titular']; ?></td>
					<td hidden=""><?= $cliente[$i]['ci']; ?></td>
	                <td><?= $cliente[$i]['r_social']." ".$cliente[$i]['ci']; ?></td>
	                <td><?= utf8_encode($cliente[$i]['nombre_t']); ?></td>
	                <td><?= utf8_encode($cliente[$i]['apellido_t']); ?></td>
	                <td><?= sizeof($clientet); ?></td>
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

    $( "#iddatatable tbody tr" ).click(function() {
    	var customerId = $(this).find("td").eq(1).html(); 
		var customerId1 = $(this).find("td").eq(0).html();   

		window.open ("v_cliente.php?id_cliente="+customerId+"&id_titu="+customerId1 ,'_blank');
	});


</script>