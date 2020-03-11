<?php

include 'clases.php';

class Renovar extends Conectar
{
    public $cant_renov;

    function __construct()
    {
        $this->cant_renov = 0;
    }

    public function comprobar_poliza($cod_poliza,$id_cia)
    {
        $fhoy = date("Y-m-d");

        $sql = "SELECT cod_poliza  FROM 
                        poliza
                        WHERE 
                        poliza.cod_poliza = '$cod_poliza' AND
                        poliza.id_cia = '$id_cia' AND
                        poliza.f_hastapoliza >= '$fhoy' AND
                        not exists (select 1 from renovar where poliza.id_poliza = renovar.id_poliza)";

        $query = mysqli_query(Conectar::con(), $sql);
        $row = mysqli_fetch_array($query);
        
        mysqli_close(Conectar::con());
        return $row;
    }

    public function renovar()
    {
        $fhoy = date("Y-m-d");
        //resto 1 mes
        $fmax = date("Y-m-d", strtotime($fhoy . "- 3 month"));

        $sql = "SELECT id_poliza, poliza.cod_poliza, nomcia, f_desdepoliza, f_hastapoliza, prima, nombre_t, apellido_t, pdf, idnom AS nombre, poliza.id_cia  FROM 
                        poliza
                        INNER JOIN
                        dcia, titular, ena
                        WHERE 
                        poliza.id_cia = dcia.idcia AND
                        poliza.id_titular = titular.id_titular AND
                        poliza.codvend = ena.cod AND
                        poliza.f_hastapoliza >= '$fmax' AND
                        poliza.f_hastapoliza <= '$fhoy' AND
                        not exists (select 1 from renovar where poliza.id_poliza = renovar.id_poliza)
                    UNION
                SELECT id_poliza, poliza.cod_poliza, nomcia, f_desdepoliza, f_hastapoliza, prima, nombre_t, apellido_t, pdf, nombre, poliza.id_cia  FROM 
                        poliza
                        INNER JOIN
                        dcia, titular, enp
                        WHERE 
                        poliza.id_cia = dcia.idcia AND
                        poliza.id_titular = titular.id_titular AND
                        poliza.codvend = enp.cod AND
                        poliza.f_hastapoliza >= '$fmax' AND
                        poliza.f_hastapoliza <= '$fhoy' AND
                        not exists (select 1 from renovar where poliza.id_poliza = renovar.id_poliza)
                    UNION
                SELECT id_poliza, poliza.cod_poliza, nomcia, f_desdepoliza, f_hastapoliza, prima, nombre_t, apellido_t, pdf, nombre, poliza.id_cia  FROM 
                        poliza
                        INNER JOIN
                        dcia, titular, enr
                        WHERE 
                        poliza.id_cia = dcia.idcia AND
                        poliza.id_titular = titular.id_titular AND
                        poliza.codvend = enr.cod AND
                        poliza.f_hastapoliza >= '$fmax' AND
                        poliza.f_hastapoliza <= '$fhoy' AND
                        not exists (select 1 from renovar where poliza.id_poliza = renovar.id_poliza)
                        ORDER BY f_hastapoliza DESC";

        $array = array();
        $query = mysqli_query(Conectar::con(), $sql);
        while ($row = mysqli_fetch_assoc($query)) {
            $array[] = $row;
        }
        $this->cant_renov = sizeof($array);
        mysqli_close(Conectar::con());
        return $array;
    }
}
