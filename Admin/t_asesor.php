<?php

require_once "../class/clases.php";

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
				<th hidden>ID</th>
                <th nowrap>Código</th>
                <th nowrap>C.I o Pasaporte</th>
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
	                <td><?= $asesor[$i]['id']; ?></td>
	                <td><?= sizeof($asesort); ?></td>
	                <td><?= "$ ".number_format($prima,2); ?></td>
					<td><?= "$ ".number_format($primaC[0]['SUM(prima_com)'],2); ?></td>
					
				</tr>
				<?php
			}

			for ($i=0; $i < sizeof($proyecto); $i++) { 
				$obj4= new Trabajo();
				$proyectot = $obj4->get_asesor_proyecto_total($proyecto[$i]['cod']); 
				$prima=0;
				for ($a=0; $a < sizeof($proyectot); $a++) { 
					$prima=$prima+$proyectot[$a]['prima'];
					$totalPrima=$totalPrima+$proyectot[$a]['prima'];
					$totalCant=$totalCant+1;
				}

				$obj6= new Trabajo();
				$primaC = $obj6->get_prima_cobrada_asesor($proyecto[$i]['cod']); 
				$totalPrimaC=$totalPrimaC+$primaC[0]['SUM(prima_com)'];

				?>
				<tr style="cursor: pointer">
					<?php
						if ($proyecto[$i]['act']==1) {
					?>
					<td nowrap class="text-success"><?= utf8_encode($proyecto[$i]['nombre']); ?></td>
					<?php
						}else {
					?>
					<td nowrap class="text-danger"><?= utf8_encode($proyecto[$i]['nombre']); ?></td>
					<?php	
						}
					?>
					<td hidden=""><?= $proyecto[$i]['id_enp']; ?></td>
	                <td><?= $proyecto[$i]['cod']; ?></td>
	                <td><?= $proyecto[$i]['id']; ?></td>

	                <td><?= sizeof($proyectot); ?></td>
	                <td><?= "$ ".number_format($prima,2); ?></td>
					<td><?= "$ ".number_format($primaC[0]['SUM(prima_com)'],2); ?></td>
	                
				</tr>
				<?php
			}




			for ($i=0; $i < sizeof($referidor); $i++) { 
				$obj6= new Trabajo();
				$referidort = $obj6->get_referidor_total($referidor[$i]['cod']); 
				$prima=0;
				for ($a=0; $a < sizeof($referidort); $a++) { 
					$prima=$prima+$referidort[$a]['prima'];
					$totalPrima=$totalPrima+$referidort[$a]['prima'];
					$totalCant=$totalCant+1;
				}

				$obj6= new Trabajo();
				$primaC = $obj6->get_prima_cobrada_asesor($referidor[$i]['cod']); 
				$totalPrimaC=$totalPrimaC+$primaC[0]['SUM(prima_com)'];
			?>
			<tr style="cursor: pointer">
					<?php
						if ($referidor[$i]['act']==1) {
					?>
					<td nowrap class="text-success"><?= utf8_encode($referidor[$i]['nombre']); ?></td>
					<?php
						}else {
					?>
					<td nowrap class="text-danger"><?= utf8_encode($referidor[$i]['nombre']); ?></td>
					<?php	
						}
					?>
					<td hidden=""><?= $referidor[$i]['id_enr']; ?></td>
	                <td><?= $referidor[$i]['cod']; ?></td>
	                <td><?= $referidor[$i]['id']; ?></td>

	                <td><?= sizeof($referidort); ?></td>
	                <td><?= "$ ".number_format($prima,2); ?></td>
					<td><?= "$ ".number_format($primaC[0]['SUM(prima_com)'],2); ?></td>
	                
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

		window.open ("v_asesor.php?cod_asesor="+customerId ,'_blank');
	});

	
</script>