<?php

require_once "../../class/clases.php";

$obj1= new Trabajo();
$asesor = $obj1->get_element('ena','idnom'); 

$obj3= new Trabajo();
$proyecto = $obj3->get_element('enp','nombre'); 

$obj5= new Trabajo();
$referidor = $obj5->get_element('enr','nombre'); 

$totalPrima=0;
$totalPrimaC=0;
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
				<th nowrap>Total Prima Cobrada</th>
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

				$obj6= new Trabajo();
				$primaC = $obj6->get_prima_cobrada_asesor($asesor[$i]['cod']); 
				$totalPrimaC=$totalPrimaC+$primaC[0]['SUM(prima_com)'];
				
				?>
				<tr style="cursor: pointer">
					<?php
						if ($asesor[$i]['act']==1) {
					?>
					<td nowrap class="text-success"><?= utf8_encode($asesor[$i]['idnom']); ?></td>
					<?php
						}else {
					?>
					<td nowrap class="text-danger"><?= utf8_encode($asesor[$i]['idnom']); ?></td>
					<?php	
						}
					?>
					<td hidden=""><?= $asesor[$i]['idena']; ?></td>
	                <td><?= $asesor[$i]['cod']; ?></td>
					<td><?= number_format($asesor[$i]['pre1'],0)."%"; ?></td>
					<td><?= number_format($asesor[$i]['gc_viajes'],0)."%"; ?></td>
	                <td><?= sizeof($asesort); ?></td>
	                <td><?= "$ ".number_format($prima,2); ?></td>
					<td><?= "$ ".number_format($primaC[0]['SUM(prima_com)'],2); ?></td>
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
                <th nowrap>Cant Pólizas <?= $totalCant; ?></th>
                <th >Total Prima Suscrita $<?= number_format($totalPrima,2); ?></th>
				<th >Total Prima Cobrada $<?= number_format($totalPrimaC,2); ?></th>
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