<?php

require_once "../class/clases.php";

$obj1= new Trabajo();
$poliza = $obj1->get_poliza_total(); 

?>


	<table class="table table-hover table-striped table-bordered display responsive" id="iddatatable" >
		<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
			<tr>
				<th hidden>f_poliza</th>
				<th hidden>id</th>
				<th>N° Póliza</th>
				<th hidden>Código Vendedor</th>
				<th>F Producción</th>
                <th>F Desde Seguro</th>
                <th>F Hasta Seguro</th>
                <th style="background-color: #E54848;">Prima Suscrita</th>
                <th nowrap>Nombre Titular</th>
                <th nowrap hidden>Apellido Titular</th>
			</tr>
		</thead>
		
		<tbody >
			<?php
			$totalsuma=0;
			$totalprima=0;
			$currency="";
			for ($i=0; $i < sizeof($poliza); $i++) { 
				//if ($poliza[$i]['id_titular']==0) {
					
				//} else {
					
				
				
				$totalsuma=$totalsuma+$poliza[$i]['sumaasegurada'];
				$totalprima=$totalprima+$poliza[$i]['prima'];

				$originalDesde = $poliza[$i]['f_desdepoliza'];
				$newDesde = date("d/m/Y", strtotime($originalDesde));
				$originalHasta = $poliza[$i]['f_hastapoliza'];
				$newHasta = date("d/m/Y", strtotime($originalHasta));

				$originalFProd = $poliza[$i]['f_poliza'];
				$newFProd = date("d/m/Y", strtotime($originalFProd));

				if ($poliza[$i]['currency']==1) {
					$currency="$ ";
				}else{$currency="Bs ";}


				if ($poliza[$i]['f_hastapoliza'] >= date("Y-m-d")) {
                ?>
				<tr style="cursor: pointer;">
					<td hidden><?php echo $poliza[$i]['f_poliza']; ?></td>
                	<td hidden><?php echo $poliza[$i]['id_poliza']; ?></td>
	                <td style="color: #2B9E34;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                <?php            
                } else{
                ?>
				<tr style="cursor: pointer;">
					<td hidden><?php echo $poliza[$i]['f_poliza']; ?></td>
                	<td hidden><?php echo $poliza[$i]['id_poliza']; ?></td>
	                <td style="color: #E54848;font-weight: bold"><?php echo $poliza[$i]['cod_poliza']; ?></td>
                <?php   
                }

				?>
				
					
					<td hidden><?php echo $poliza[$i]['codvend']; ?></td>
					<td><?php echo $newFProd; ?></td>
	                <td><?php echo $newDesde; ?></td>
	                <td><?php echo $newHasta; ?></td>
	                <td><?php echo $currency.number_format($poliza[$i]['prima'],2); ?></td>
	                <td nowrap><?php echo $poliza[$i]['nombre_t']." ".$poliza[$i]['apellido_t']; ?></td>
	                <td nowrap hidden><?php echo $poliza[$i]['apellido_t']; ?></td>
				</tr>
				<?php
				//}
			}
			?>
		</tbody>


		<tfoot>
			<tr>
				<th hidden>f_poliza</th>
				<th hidden>id</th>
				<th>N° Póliza</th>
				<th hidden>Código Vendedor</th>
				<th>F Producción</th>
                <th>F Desde Seguro</th>
                <th>F Hasta Seguro</th>
                <th>Prima Suscrita $<?php echo number_format($totalprima,2); ?></th>
                <th>Nombre Titular</th>
                <th hidden>Apellido Titular</th>
			</tr>
		</tfoot>
	</table>


	<h1 class="title">Total de Prima</h1>
	<h1 class="title text-danger">$ <?php  echo number_format($totalprima,2);?></h1>


<script type="text/javascript">
	$(document).ready(function() {
		$('#iddatatable').DataTable({
			scrollX: 300,
			"order": [[ 0, "desc" ]]
		});
	} );

	$(function () {
      $('[data-tooltip="tooltip"]').tooltip()
    });

    $( "#iddatatable tbody tr" ).click(function() {
    	var customerId = $(this).find("td").eq(1).html();   

	  	window.location.href = "v_poliza.php?id_poliza="+customerId;
	});

	


</script>