<?php

require_once "../class/clases.php";

$obj1= new Trabajo();
$vehiculo = $obj1->get_element('dveh','idveh'); 

?>



	<table class="table table-hover table-striped table-bordered display responsive nowrap" id="iddatatable" style="width:100%">
		<thead style="background-color: #00bcd4;color: white; font-weight: bold;">
			<tr>
				<th hidden="">ID</th>
				<th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Serial</th>
                <th>N° Recibo</th>
                <th>Acciones</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th hidden="">ID</th>
				<th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Serial</th>
                <th>N° Recibo</th>
                <th>Acciones</th>
			</tr>
		</tfoot>
		<tbody >
			<?php
			for ($i=0; $i < sizeof($vehiculo); $i++) { 
				if ($vehiculo[$i]['placa']=="-") {
					
				}else {
				?>
				<tr >
					<td hidden=""><?php echo $vehiculo[$i]['idveh']; ?></td>
	                <td><?php echo $vehiculo[$i]['placa']; ?></td>
	                <td><?php echo $vehiculo[$i]['marca']; ?></td>
	                <td><?php echo $vehiculo[$i]['mveh']; ?></td>
	                <td><?php echo $vehiculo[$i]['f_veh']; ?></td>
	                <td><?php echo $vehiculo[$i]['serial']; ?></td>
	                <td><?php echo $vehiculo[$i]['cod_recibo']; ?></td>
					<td style="text-align: center;">
	                    <span data-tooltip="tooltip" data-placement="top" title="Editar" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizar('<?php echo $vehiculo[$i]['idtitular'] ?>')"><i class="fa fa-pencil" aria-hidden="true"></i></span>
	                    <span onclick="eliminarDatos('<?php echo $vehiculo[$i]['idtitular']; ?>')" data-tooltip="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></span>
						</span>
	                </td>
				</tr>
				<?php
				}
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
    })


</script>