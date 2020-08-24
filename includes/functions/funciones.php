<?php
    function productosJson(&$boletos, &$camisas = 0, &$etiquetas = 0){
        $dias = array(0 => 'un_dia', 1 => 'pase_completo', 2 => 'pase_2dias' );
        $total_boletos = array_combine($dias, $boletos);
        $json = array();

        foreach( $total_boletos as $key => $boleto ):
            if ((int) $boleto['cantidad'] > 0) {
                $json[$key] = (int) $boleto['cantidad'];
            }
        endforeach;

        if ((int) $camisas > 0) {
            $json['camisas'] = (int) $camisas;
        }
        
        if ((int) $etiquetas > 0) {
            $json['etiquetas'] = (int) $etiquetas;
        }

        return json_encode($json);
    }

    function eventosJson(&$eventos){
        $json = array();

        foreach ($eventos as $evento) {
            $json['eventos'][] = $evento;
        }

        return json_encode($json);
    }
?>