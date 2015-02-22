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
	
     case 'gasto' :
          
     		switch ($_POST['acao']){
     			
     			case 'salvar' :
     					header('Content-Type: application/json');     			
     					$gastoController = new GastoController();
	
     					$gastoController->salvarGasto($_POST['descricao'], $_POST['valor'], AppUtil::dataParaBd($_POST['data']), $_POST['observacao'], '0', $_POST['tipo-gasto']);
     					echo json_encode(["type" => 'success']);
     					exit;
                case 'pagar' :
                        $gastoController = new GastoController();
                        $gastoController->pagarGasto($_POST['idGasto'], $_POST['valorGasto']);
                        echo json_encode(["type" => 'success']);
                        exit;
     		}

    case 'grafico' :

            switch ($_POST['grafico']){

                case 'donut' :
                    $gastoController = new GastoController();

                    $gasto = $gastoController->getGastosPorDescricaoGrafico();                                       
                    echo json_encode($gasto);

                    break;
            }
}