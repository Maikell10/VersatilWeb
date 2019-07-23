<?php

require_once "../../class/clases.php";


$obj3= new Trabajo();
$proyecto = $obj3->get_element('enp','nombre'); 


$totalPrima=0;
$totalCant=0;

?>


<center>
	<div class="table-responsive">
	<table class="table table-hover table-striped table-bordered" id="iddatatable" >
		<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
			<tr>
				<th nowrap>Nombre</th>
				<th hidden="">ID</th>
                <th nowrap>Código</th>
                <th nowrap>C.I o Pasaporte</th>
                <th nowrap>Cant Pólizas</th>
                <th nowrap>Total Prima Suscrita</th>
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
					<td nowrap><?php echo utf8_encode($proyecto[$i]['nombre']); ?></td>
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
                <th nowrap>Cant Pólizas <?php echo $totalCant; ?></th>
                <th nowrap>Total Prima Suscrita $<?php echo number_format($totalPrima,2); ?></th>
			</tr>
		</tfoot>
	</table>
	</div>
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

    $( "#iddatatable tr" ).click(function() {
    	var customerId = $(this).find("td").eq(2).html();   

		window.open ("../v_asesor.php?cod_asesor="+customerId ,'_blank');
	});

	
</script>