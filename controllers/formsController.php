<?php
include '../autoload.php';

switch ($_POST['tipo']) {  
        
    case 'login' :        
            $login = $_REQUEST ['login'];
            $senha = $_REQUEST ['senha'];
            
            if ($login && $senha) {
                SiteController::logar ( $login, $senha );
                if (SiteController::logado ()) {
                    echo json_encode (["type" => 'success']);
                    exit;
                } else {
                    echo json_encode (["type" => 'danger']);
                    exit;
                }
            } else {
                echo json_encode (["type" => 'warning']);
                exit;
            }
            break;
        
        case 'logout' :
            SiteController::logout ();
            AppUtil::redirecionar ();
            break;  

    case 'grafico' :

            switch ($_POST['grafico']){

                case 'donut' :
                    $gastoController = new GastoController();

                    $gasto = $gastoController->getGastosPorDescricaoGrafico();                                       
                    echo json_encode($gasto);

                    break;
            }
}