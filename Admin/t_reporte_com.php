<?php

require_once "../class/clases.php";


$obj1 = new Trabajo();
$reporte = $obj1->get_rep_com();



$totalPrimaCom = 0;
$totalCom = 0;

?>


<center>
	<div class="table-responsive">
		<table class="table table-hover table-striped table-bordered" id="iddatatable1">
			<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
				<tr>
					<th hidden="">ID</th>
					<th hidden="">ID</th>
					<th style="width:10%" nowrap>Fecha Hasta Reporte</th>
					<th style="width:20%" nowrap>Prima Cobrada</th>
					<th style="width:20%" nowrap>Comisión Cobrada</th>
					<th style="width:50%" nowrap>Compañía</th>
					<th nowrap>Fecha Pago de la GC</th>
					<th>PDF</th>
				</tr>
			</thead>

			<tbody>
				<?php
				for ($i = 0; $i < sizeof($reporte); $i++) {

					$prima = 0;
					$comi = 0;
					$obj4 = new Trabajo();
					$reporte_c = $obj4->get_element_by_id('comision', 'id_rep_com', $reporte[$i]['id_rep_com']);

					for ($a = 0; $a < sizeof($reporte_c); $a++) {

						$prima = $prima + $reporte_c[$a]['prima_com'];
						$comi = $comi + $reporte_c[$a]['comision'];
						$totalPrimaCom = $totalPrimaCom + $reporte_c[$a]['prima_com'];
						$totalCom = $totalCom + $reporte_c[$a]['comision'];
					}

					$f_pago_gc = date("d-m-Y", strtotime($reporte[$i]['f_pago_gc']));
					$f_hasta_rep = date("d-m-Y", strtotime($reporte[$i]['f_hasta_rep']));

				?>
					<tr style="cursor: pointer">
						<td hidden=""><?= $reporte[$i]['f_hasta_rep']; ?></td>
						<td hidden=""><?= $reporte[$i]['id_rep_com']; ?></td>
						<td><?= $f_hasta_rep; ?></td>
						<td align="right"><?= "$ " . number_format($prima, 2); ?></td>
						<td align="right"><?= "$ " . number_format($comi, 2); ?></td>
						<td nowrap><?= ($reporte[$i]['nomcia']); ?></td>
						<td><?= $f_pago_gc; ?></td>
						<td>
							<?php
							if ($reporte[$i]['pdf'] == 1) {

							?>
								<a href="download.php?id_rep_com=<?= $reporte[$i]['id_rep_com']; ?>" class="btn btn-white btn-round btn-sm" target="_blank" style="float: right"><img src="../assets/img/pdf-logo.png" width="30" id="pdf"></a>
							<?php
							} else {
							}
							?>
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>

			<tfoot>
				<tr>
					<th hidden="">ID</th>
					<th hidden="">ID</th>
					<th>Fecha Hasta Reporte</th>
					<th>Prima Cobrada <?= "$ " . number_format($totalPrimaCom, 2); ?></th>
					<th>Comisión Cobrada <?= "$ " . number_format($totalCom, 2); ?></th>
					<th>Compañía</th>
					<th>Fecha Pago de la GC</th>
					<th>PDF</th>
				</tr>
			</tfoot>
		</table>
	</div>
</center>


<script type="text/javascript">
	$(document).ready(function() {
		$('#iddatatable1').DataTable({
			scrollX: 300,
			"order": [
				[0, "desc"]
			]
			//"ordering": false
		});
	});

	$(function() {
		$('[data-tooltip="tooltip"]').tooltip()
	});

	$("#iddatatable1 tbody tr").dblclick(function() {
		var customerId = $(this).find("td").eq(1).html();

		window.open("v_reporte_com.php?id_rep_com=" + customerId, '_blank');
	});
</script>