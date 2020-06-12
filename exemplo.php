<?php

ini_set('default_charset','UTF-8');
        if($_GET){
            $produto = $_GET['produto'];
            $quantidade = $_GET['quant'];
            $data = $_GET['data'];
            $valor = $_GET['valor'];
            
    
            for($cont=1;$cont <= $quantidade; $cont++){
                echo"<table border='1'width='200'><tr><td>"
                .$cont.
                "</td><td> AÇÃO ENTRE AMIGOS<br> Prêmio"
                .$produto.
                "<br>Nº"
                .$cont.
                "<br> Valor da Rifa R$ "
                .$valor.
                "<br> Data do sorteio:"
                .$data.
                " </td></tr></table>";
            }
 
        }
?>