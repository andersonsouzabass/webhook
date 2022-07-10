<?php

    // vamos fazer os dois endpoints, / e /webhook
    $request = $_SERVER['REQUEST_URI'];
    $request = explode("/", $request);
    $metodo = $_SERVER['REQUEST_METHOD'];

    // se existir o indice [1] a gente faz um switch para varias situaçoes
    if( isset($request[1]) and $metodo == 'POST' ) {

        switch ( $request[1] ) {

            //aqui caimos na situacao da nossa api /webhook
            case 'webhook':
     
                // vamos pegar o conteudo do POST
                $data = file_get_contents("php://input");
                
                // vamos gravar o que esta dentro de $data
                // vamos fazer o nome ficar dinamico
                $log = fopen('logs/'.date('dm-his')."-log.txt", "w") or die("Impossível abrir o ficheiro!");
                fwrite($log, $data);
                fclose($log);

                var_dump($data);

                break;
            
            // por padrao retornamos error;
            default:
                header('Content-Type: application/json');
                echo json_encode(['error' => true, 'message' => 'rota não definida']);
                break;
        }

    }else{
        header('Content-Type: application/json');
        echo json_encode(['error' => true, 'message' => 'rota não definida']);
    }

?>