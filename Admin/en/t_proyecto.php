<?php

require_once "../../class/clases.php";


$obj3= new Trabajo();
$proyecto = $obj3->get_element('enp','nombre'); 


$totalPrima=0;
$totalCant=0;

?>


<center>
	<table class="table table-hover table-striped table-bordered display table-responsive nowrap" id="iddatatable" >
		<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
			<tr>
				<th>Nombre</th>
				<th hidden="">ID</th>
                <th>Código</th>
                <th>C.I o Pasaporte</th>
                <th>Cant Pólizas</th>
                <th>Total Prima Suscrita</th>
			</tr>
		</thead>
		
		<tbody >
			<?php
			for ($i=0; $i < sizeof($proyecto); $i++) { 
				$obj2= new Trabajo();
				$proyectot = $obj2->get_asesor_proyecto_total($proyecto[$i]['cod']); 
				$prima=0;
				for ($a=0; $a < sizeof($proyectot); $a++) { 
					$prima=$prima+$proyectot[$a]['prima'];
					$totalPrima=$totalPrima+$proyectot[$a]['prima'];
					$totalCant=$totalCant+1;
				}
				
				?>
				<tr style="cursor: pointer">
					<td><?php echo utf8_encode($proyecto[$i]['nombre']); ?></td>
					<td hidden=""><?php echo $proyecto[$i]['id_enp']; ?></td>
	                <td><?php echo $proyecto[$i]['cod']; ?></td>
	                <td><?php echo $proyecto[$i]['id']; ?></td>
	                <td><?php echo sizeof($proyectot); ?></td>
	                <td><?php echo "$ ".number_format($prima,2); ?></td>
				</tr>
				<?php
			}
			?>
		</tbody>

		<tfoot>
			<tr>
				<th>Nombre</th>
				<th hidden="">ID</th>
                <th>Código</th>
                <th>C.I o Pasaporte</th>
                <th>Cant Pólizas <?php echo $totalCant; ?></th>
                <th>Total Prima Suscrita $<?php echo number_format($totalPrima,2); ?></th>
			</tr>
		</tfoot>
	</table>
</center>


<script type="text/javascript">
	$(document).ready(function() {
		$('#iddatatable').DataTable({
			scrollX: 300,
			//"ordering": false
		});
	} );

	$(function () {
      $('[data-tooltip="tooltip"]').tooltip()
    });

    $( "#iddatatable tr" ).dblclick(function() {
    	var customerId = $(this).find("td").eq(2).html();   

	  	window.location.href = "../v_asesor.php?cod_asesor="+customerId;
	});

	
</script>