<?php

include 'clases.php';

class Comparativo extends Conectar
{

    public function get_element_by_id($tabla, $cond, $campo)
    {
        $sql = "SELECT * FROM $tabla WHERE $cond = '$campo'";

        $query = mysqli_query(Conectar::con(), $sql);
        $row = mysqli_fetch_array($query);

        mysqli_close(Conectar::con());
        return $row;
    }

    public function get_prima_mm($cond1, $cond2, $cia, $ramo, $tipo_cuenta)
    {
        if ($cia != '' && $tipo_cuenta != '' && $ramo != '') {
            // create sql part for IN condition by imploding comma after each id
            $ciaIn = "('" . implode("','", $cia) . "')";

            // create sql part for IN condition by imploding comma after each id
            $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) . "')";

            // create sql part for IN condition by imploding comma after each id
            $ramoIn = "('" . implode("','", $ramo) . "')";

            $sql = "SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nomcia IN " . $ciaIn . " AND
						nramo IN " . $ramoIn . " AND
						t_cuenta  IN " . $tipo_cuentaIn . "
						ORDER BY Month(f_desdepoliza) ASC ";
        } //1
        if ($cia == '' && $tipo_cuenta == '' && $ramo == '') {
            $sql = "SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' 
						ORDER BY Month(f_desdepoliza) ASC";
        } //2
        if ($cia != '' && $tipo_cuenta == '' && $ramo == '') {

            // create sql part for IN condition by imploding comma after each id
            $ciaIn = "('" . implode("','", $cia) . "')";

            $sql = "SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nomcia IN " . $ciaIn . " 
						ORDER BY Month(f_desdepoliza) ASC";
        } //3
        if ($cia == '' && $tipo_cuenta != '' && $ramo == '') {

            // create sql part for IN condition by imploding comma after each id
            $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) . "')";

            $sql = "SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						t_cuenta  IN " . $tipo_cuentaIn . " 
						ORDER BY Month(f_desdepoliza) ASC";
        } //4
        if ($cia == '' && $tipo_cuenta == '' && $ramo != '') {

            // create sql part for IN condition by imploding comma after each id
            $ramoIn = "('" . implode("','", $ramo) . "')";

            $sql = "SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nramo IN " . $ramoIn . "  
						ORDER BY Month(f_desdepoliza) ASC";
        } //5
        if ($cia != '' && $tipo_cuenta != '' && $ramo == '') {
            // create sql part for IN condition by imploding comma after each id
            $ciaIn = "('" . implode("','", $cia) . "')";

            // create sql part for IN condition by imploding comma after each id
            $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) . "')";

            $sql = "SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nomcia IN " . $ciaIn . " AND
						t_cuenta  IN " . $tipo_cuentaIn . " 
						ORDER BY Month(f_desdepoliza) ASC";
        } //6
        if ($cia == '' && $tipo_cuenta != '' && $ramo != '') {
            // create sql part for IN condition by imploding comma after each id
            $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) . "')";

            // create sql part for IN condition by imploding comma after each id
            $ramoIn = "('" . implode("','", $ramo) . "')";

            $sql = "SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nramo IN " . $ramoIn . " AND
						t_cuenta  IN " . $tipo_cuentaIn . " 
						ORDER BY Month(f_desdepoliza) ASC";
        } //7
        if ($cia != '' && $tipo_cuenta == '' && $ramo != '') {
            // create sql part for IN condition by imploding comma after each id
            $ciaIn = "('" . implode("','", $cia) . "')";

            // create sql part for IN condition by imploding comma after each id
            $ramoIn = "('" . implode("','", $ramo) . "')";

            $sql = "SELECT DISTINCT Month(f_desdepoliza) FROM poliza,drecibo,dcia,dramo
						WHERE 
						poliza.id_poliza = drecibo.idrecibo AND
						poliza.id_cod_ramo=dramo.cod_ramo AND
						poliza.id_cia=dcia.idcia AND
						f_desdepoliza >= '$cond1' AND
						f_desdepoliza <= '$cond2' AND
						nomcia IN " . $ciaIn . " AND
						nramo IN " . $ramoIn . "  
						ORDER BY Month(f_desdepoliza) ASC";
        } //8

        $array = array();
        $query = mysqli_query(Conectar::con(), $sql);
        while ($row = mysqli_fetch_assoc($query)) {
            $array[] = $row;
        }
        mysqli_close(Conectar::con());
        return $array;
    }

    public function get_poliza_prima_mm($ramo, $desde, $hasta, $cia, $tipo_cuenta)
    {

        if ($cia != '' && $tipo_cuenta != '' && $ramo != '') {
            // create sql part for IN condition by imploding comma after each id
            $ciaIn = "('" . implode("','", $cia) . "')";

            // create sql part for IN condition by imploding comma after each id
            $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) . "')";

            // create sql part for IN condition by imploding comma after each id
            $ramoIn = "('" . implode("','", $ramo) . "')";

            $sql = "SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' AND
								nomcia IN " . $ciaIn . " AND
								nramo IN " . $ramoIn . " AND
								t_cuenta  IN " . $tipo_cuentaIn . " ";
        } //1
        if ($cia == '' && $tipo_cuenta == '' && $ramo == '') {
            $sql = "SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' ";
        } //2
        if ($cia != '' && $tipo_cuenta == '' && $ramo == '') {

            // create sql part for IN condition by imploding comma after each id
            $ciaIn = "('" . implode("','", $cia) . "')";

            $sql = "SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							poliza.id_cia=dcia.idcia AND 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							f_desdepoliza >= '$desde' AND
							f_desdepoliza <= '$hasta' AND
							nomcia IN " . $ciaIn . " ";
        } //3
        if ($cia == '' && $tipo_cuenta != '' && $ramo == '') {

            // create sql part for IN condition by imploding comma after each id
            $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) . "')";

            $sql = "SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							poliza.id_cia=dcia.idcia AND 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							f_desdepoliza >= '$desde' AND
							f_desdepoliza <= '$hasta' AND
							t_cuenta  IN " . $tipo_cuentaIn . " ";
        } //4
        if ($cia == '' && $tipo_cuenta == '' && $ramo != '') {

            // create sql part for IN condition by imploding comma after each id
            $ramoIn = "('" . implode("','", $ramo) . "')";

            $sql = "SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
							poliza.id_poliza = drecibo.idrecibo AND 
							poliza.id_cod_ramo=dramo.cod_ramo AND 
							poliza.id_cia=dcia.idcia AND 
							poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
							f_desdepoliza >= '$desde' AND
							f_desdepoliza <= '$hasta' AND
							nramo IN " . $ramoIn . "  ";
        } //5
        if ($cia != '' && $tipo_cuenta != '' && $ramo == '') {
            // create sql part for IN condition by imploding comma after each id
            $ciaIn = "('" . implode("','", $cia) . "')";

            // create sql part for IN condition by imploding comma after each id
            $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) . "')";

            $sql = "SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' AND
								nomcia IN " . $ciaIn . " AND
								t_cuenta  IN " . $tipo_cuentaIn . " ";
        } //6
        if ($cia == '' && $tipo_cuenta != '' && $ramo != '') {
            // create sql part for IN condition by imploding comma after each id
            $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) . "')";

            // create sql part for IN condition by imploding comma after each id
            $ramoIn = "('" . implode("','", $ramo) . "')";

            $sql = "SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' AND
								nramo IN " . $ramoIn . " AND
								t_cuenta  IN " . $tipo_cuentaIn . " ";
        } //7
        if ($cia != '' && $tipo_cuenta == '' && $ramo != '') {
            // create sql part for IN condition by imploding comma after each id
            $ciaIn = "('" . implode("','", $cia) . "')";

            // create sql part for IN condition by imploding comma after each id
            $ramoIn = "('" . implode("','", $ramo) . "')";

            $sql = "SELECT * FROM poliza, drecibo, dcia, dramo, tipo_poliza WHERE 
								poliza.id_poliza = drecibo.idrecibo AND 
								poliza.id_cod_ramo=dramo.cod_ramo AND 
								poliza.id_cia=dcia.idcia AND 
								poliza.id_tpoliza=tipo_poliza.id_t_poliza AND
								f_desdepoliza >= '$desde' AND
								f_desdepoliza <= '$hasta' AND
								nomcia IN " . $ciaIn . " AND
								nramo IN " . $ramoIn . "  ";
        } //8

        $array = array();
        $query = mysqli_query(Conectar::con(), $sql);
        while ($row = mysqli_fetch_assoc($query)) {
            $array[] = $row;
        }
        mysqli_close(Conectar::con());
        return $array;
    }

    public function get_poliza_pc_mm($ramo, $desde, $hasta, $cia, $tipo_cuenta)
    {
        if ($cia != '' && $tipo_cuenta != '' && $ramo != '') {
            // create sql part for IN condition by imploding comma after each id
            $ciaIn = "('" . implode("','", $cia) . "')";

            // create sql part for IN condition by imploding comma after each id
            $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) . "')";

            // create sql part for IN condition by imploding comma after each id
            $ramoIn = "('" . implode("','", $ramo) . "')";

            $sql = "SELECT prima_com, comision FROM comision
                        INNER JOIN poliza, dcia, dramo
                        WHERE 
                            poliza.id_cod_ramo=dramo.cod_ramo AND 
                            poliza.id_cia=dcia.idcia AND 
                            poliza.id_poliza=comision.id_poliza AND
                            f_pago_prima >= '$desde' AND
                            f_pago_prima <= '$hasta' AND
                            nomcia IN " . $ciaIn . " AND
                            nramo IN " . $ramoIn . " AND
                            t_cuenta  IN " . $tipo_cuentaIn . " ";
        } //1
        if ($cia == '' && $tipo_cuenta == '' && $ramo == '') {
            $sql = "SELECT prima_com, comision FROM comision
                        INNER JOIN poliza, dcia, dramo
                        WHERE 
                            poliza.id_cod_ramo=dramo.cod_ramo AND 
                            poliza.id_cia=dcia.idcia AND 
                            poliza.id_poliza=comision.id_poliza AND
                            f_pago_prima >= '$desde' AND
                            f_pago_prima <= '$hasta' ";
        } //2
        if ($cia != '' && $tipo_cuenta == '' && $ramo == '') {

            // create sql part for IN condition by imploding comma after each id
            $ciaIn = "('" . implode("','", $cia) . "')";

            $sql = "SELECT prima_com, comision FROM comision
                        INNER JOIN poliza, dcia, dramo
                        WHERE 
                            poliza.id_cod_ramo=dramo.cod_ramo AND 
                            poliza.id_cia=dcia.idcia AND 
                            poliza.id_poliza=comision.id_poliza AND
                            f_pago_prima >= '$desde' AND
                            f_pago_prima <= '$hasta' AND
							nomcia IN " . $ciaIn . " ";
        } //3
        if ($cia == '' && $tipo_cuenta != '' && $ramo == '') {

            // create sql part for IN condition by imploding comma after each id
            $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) . "')";

            $sql = "SELECT prima_com, comision FROM comision
                        INNER JOIN poliza, dcia, dramo
                        WHERE 
                            poliza.id_cod_ramo=dramo.cod_ramo AND 
                            poliza.id_cia=dcia.idcia AND 
                            poliza.id_poliza=comision.id_poliza AND
                            f_pago_prima >= '$desde' AND
                            f_pago_prima <= '$hasta' AND
							t_cuenta  IN " . $tipo_cuentaIn . " ";
        } //4
        if ($cia == '' && $tipo_cuenta == '' && $ramo != '') {

            // create sql part for IN condition by imploding comma after each id
            $ramoIn = "('" . implode("','", $ramo) . "')";

            $sql = "SELECT prima_com, comision FROM comision
                        INNER JOIN poliza, dcia, dramo
                        WHERE 
                            poliza.id_cod_ramo=dramo.cod_ramo AND 
                            poliza.id_cia=dcia.idcia AND 
                            poliza.id_poliza=comision.id_poliza AND
                            f_pago_prima >= '$desde' AND
                            f_pago_prima <= '$hasta' AND
							nramo IN " . $ramoIn . "  ";
        } //5
        if ($cia != '' && $tipo_cuenta != '' && $ramo == '') {
            // create sql part for IN condition by imploding comma after each id
            $ciaIn = "('" . implode("','", $cia) . "')";

            // create sql part for IN condition by imploding comma after each id
            $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) . "')";

            $sql = "SELECT prima_com, comision FROM comision
                            INNER JOIN poliza, dcia, dramo
                            WHERE 
                                poliza.id_cod_ramo=dramo.cod_ramo AND 
                                poliza.id_cia=dcia.idcia AND 
                                poliza.id_poliza=comision.id_poliza AND
                                f_pago_prima >= '$desde' AND
                                f_pago_prima <= '$hasta' AND
								nomcia IN " . $ciaIn . " AND
								t_cuenta  IN " . $tipo_cuentaIn . " ";
        } //6
        if ($cia == '' && $tipo_cuenta != '' && $ramo != '') {
            // create sql part for IN condition by imploding comma after each id
            $tipo_cuentaIn = "('" . implode("','", $tipo_cuenta) . "')";

            // create sql part for IN condition by imploding comma after each id
            $ramoIn = "('" . implode("','", $ramo) . "')";

            $sql = "SELECT prima_com, comision FROM comision
                            INNER JOIN poliza, dcia, dramo
                            WHERE 
                                poliza.id_cod_ramo=dramo.cod_ramo AND 
                                poliza.id_cia=dcia.idcia AND 
                                poliza.id_poliza=comision.id_poliza AND
                                f_pago_prima >= '$desde' AND
                                f_pago_prima <= '$hasta' AND
								nramo IN " . $ramoIn . " AND
								t_cuenta  IN " . $tipo_cuentaIn . " ";
        } //7
        if ($cia != '' && $tipo_cuenta == '' && $ramo != '') {
            // create sql part for IN condition by imploding comma after each id
            $ciaIn = "('" . implode("','", $cia) . "')";

            // create sql part for IN condition by imploding comma after each id
            $ramoIn = "('" . implode("','", $ramo) . "')";

            $sql = "SELECT prima_com, comision FROM comision
                            INNER JOIN poliza, dcia, dramo
                            WHERE 
                                poliza.id_cod_ramo=dramo.cod_ramo AND 
                                poliza.id_cia=dcia.idcia AND 
                                poliza.id_poliza=comision.id_poliza AND
                                f_pago_prima >= '$desde' AND
                                f_pago_prima <= '$hasta' AND
								nomcia IN " . $ciaIn . " AND
								nramo IN " . $ramoIn . "  ";
        } //8

        $array = array();
        $query = mysqli_query(Conectar::con(), $sql);
        while ($row = mysqli_fetch_assoc($query)) {
            $array[] = $row;
        }
        mysqli_close(Conectar::con());
        return $array;
    }

    public function resumen_mm()
    {
        $sql = "SELECT *  FROM 
                        poliza
                        INNER JOIN drecibo
                        WHERE 
                        poliza.id_poliza = drecibo.idrecibo";
    }
}
