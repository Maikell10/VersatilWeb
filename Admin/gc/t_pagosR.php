<?php

require_once "../../class/clases.php";

$obj1 = new Trabajo();
$ref = $obj1->get_gc_h_r();

?>



<table class="table table-hover table-striped table-bordered" id="iddatatable" style="cursor: pointer;">
    <thead style="background-color: #00bcd4;color: white; font-weight: bold;">
        <tr>
            <th hidden>Id Póliza</th>
            <th>N° Póliza</th>
            <th>Referidor</th>
            <th>Monto GC</th>
            <th>Fecha Creación</th>
            <th>Nº Pago</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 0; $i < sizeof($ref); $i++) {

            $newCreated = date("d/m/Y", strtotime($ref[$i]['created_at']));
            $newCreatedH = date("h:i:s a", strtotime($ref[$i]['created_at']));
            ?>
            <tr>
                <td hidden><?= $ref[$i]['id_poliza'] ?></td>
                <td><?= $ref[$i]['cod_poliza'] ?></td>
                <td><?= $ref[$i]['nombre'] ?></td>
                <td><?= $ref[$i]['monto'] ?></td>
                <td><?= $newCreated . ' ' . $newCreatedH ?></td>
                <td></td>
                <td><a onclick="eliminar(<?= $ref[$i]['id_poliza']; ?>)" class="btn btn-danger btn-sm btn-block" data-toggle="tooltip" data-placement="right" title="Eliminar" style="color:white">X</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>


<script type="text/javascript">
    $('#iddatatable').DataTable({
        //scrollX: 300,
        "order": [[ 0, "desc" ]],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });
    /*$(document).ready(function() {
        $('#iddatatable').DataTable({
            scrollX: 300
        });
    });

    $(function() {
        $('[data-tooltip="tooltip"]').tooltip()
    })*/
</script>