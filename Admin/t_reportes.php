<?php

require_once "../class/clases.php";


$obj1= new Trabajo();
$cia = $obj1->get_distinc_c_rep_com(); 



$totalPrimaCom=0;
$totalCom=0;

?>


<center>
	<table class="table table-hover table-striped table-bordered table-responsive nowrap" id="iddatatable">
		<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
			<tr>
				<th style="width:40%">Nombre de Compañía</th>
				<th hidden="">ID</th>
                <th style="width:20%">Prima Suscrita</th>
                <th style="width:20%">Prima Cobrada</th>
                <th style="width:20%">Comisión Cobrada</th>
			</tr>
		</thead>
		
		<tbody >
			<?php
			for ($i=0; $i < sizeof($cia); $i++) { 

				$primap=0;
				$obj5= new Trabajo();
				$poliza = $obj5->get_poliza_total_by_num($cia[$i]['id_cia']);
				for ($c=0; $c < sizeof($poliza); $c++) { 
					$primap=$primap+$poliza[0]['prima'];
				}
				


				$obj3= new Trabajo();
				$reporte1 = $obj3->get_element_by_id('rep_com','id_cia',$cia[$i]['id_cia']); 
				$prima=0;
				$comi=0;
				for ($a=0; $a < sizeof($reporte1); $a++) { 
					$obj4= new Trabajo();
					$reporte = $obj4->get_element_by_id('comision','id_rep_com',$reporte1[$a]['id_rep_com']);
					for ($b=0; $b < sizeof($reporte); $b++) { 
						$prima=$prima+$reporte[$b]['prima_com'];
						$comi=$comi+$reporte[$b]['comision'];
						$totalPrimaCom=$totalPrimaCom+$reporte[$b]['prima_com'];
						$totalCom=$totalCom+$reporte[$b]['comision'];
					} 
				}

				
				?>
				<tr style="cursor: pointer">
					<td><?= ($cia[$i]['nomcia']); ?></td>
					<td hidden=""><?= $asesor[$i]['idena']; ?></td>
	                <td><?= number_format($primap,2); ?></td>
	                <td><?= number_format($prima,2); ?></td>
	                <td><?= "$ ".number_format($comi,2); ?></td>
				</tr>
				<?php
			}
			?>
		</tbody>

		<tfoot>
			<tr>
				<th>Nombre de Compañía</th>
				<th hidden="">ID</th>
                <th>Prima Suscrita</th>
                <th>Prima Cobrada <?= "$ ".number_format($totalPrimaCom,2); ?></th>
                <th>Comisión Cobrada <?= "$ ".number_format($totalCom,2); ?></th>
			</tr>
		</tfoot>
	</table>
</center>


<script type="text/javascript">
	$(document).ready(function() {
		$('#iddatatable').DataTable({
			scrollX: 300,
			pageLength: 50 
		});
	} );

	$(function () {
      $('[data-tooltip="tooltip"]').tooltip()
    });

    $( "#iddatatable tbody tr" ).click(function() {
    	var customerId = $(this).find("td").eq(0).html();   

		window.open ("b_reportes1.php?anio=&mes=&cia="+customerId ,'_blank');
	});

	
</script>