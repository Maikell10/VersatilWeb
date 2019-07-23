<?php

require_once "../../class/clases.php";

$obj1= new Trabajo();
$asesor = $obj1->get_element('ena','idnom'); 

$obj3= new Trabajo();
$proyecto = $obj3->get_element('enp','nombre'); 

$obj5= new Trabajo();
$referidor = $obj5->get_element('enr','nombre'); 

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
				<th nowrap>%GC</th>
				<th nowrap>%GC Viajes</th>
                <th nowrap>Cant Pólizas</th>
                <th nowrap>Total Prima Suscrita</th>
			</tr>
		</thead>
		
		<tbody >
			<?php
			for ($i=0; $i < sizeof($asesor); $i++) { 
				$obj2= new Trabajo();
				$asesort = $obj2->get_asesor_total($asesor[$i]['cod']); 
				$prima=0;
				for ($a=0; $a < sizeof($asesort); $a++) { 
					$prima=$prima+$asesort[$a]['prima'];
					$totalPrima=$totalPrima+$asesort[$a]['prima'];
					$totalCant=$totalCant+1;
				}
				
				?>
				<tr style="cursor: pointer">
					<td nowrap><?php echo utf8_encode($asesor[$i]['idnom']); ?></td>
					<td hidden=""><?php echo $asesor[$i]['idena']; ?></td>
	                <td><?php echo $asesor[$i]['cod']; ?></td>
					<td><?php echo number_format($asesor[$i]['pre1'],0)."%"; ?></td>
					<td><?php echo number_format($asesor[$i]['gc_viajes'],0)."%"; ?></td>
	                <td><?php echo sizeof($asesort); ?></td>
	                <td><?php echo "$ ".number_format($prima,2); ?></td>
				</tr>
				<?php
			}
			?>
		</tbody>

		<tfoot>
			<tr>
				<th nowrap>Nombre</th>
				<th hidden="">ID</th>
                <th>Código</th>
				<th>%GC</th>
				<th>%GC Viajes</th>
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

    $( "#iddatatable tbody tr" ).click(function() {
    	var customerId = $(this).find("td").eq(2).html();   

		window.open ("../v_asesor.php?cod_asesor="+customerId ,'_blank');
	});

	
</script>