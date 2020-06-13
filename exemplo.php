<?php

ini_set('default_charset', 'UTF-8');
if ($_GET) {
    if (isset($_GET['produto']) && isset($_GET['quant']) && isset($_GET['data']) && isset($_GET['valor'])) {

        $produto = $_GET['produto'];
        $quantidade = $_GET['quant'];
        $dataOriginal = $_GET['data'];
        $valor = $_GET['valor'];

        $data = date("d/m/Y", strtotime($dataOriginal));
        $fonte = 'arial.ttf';
        $fonteNegrito = 'arial-black.ttf';

        //criar imagem
        $rifaBase = imagecreate(650, 200);

        //cores
        $branco = imagecolorallocate($rifaBase, 250, 250, 250);
        $preto = imagecolorallocate($rifaBase, 10, 10, 10);
        $cinza = imagecolorallocate($rifaBase, 230, 230, 230);
        //estilo de linha pontilhado; 4 pixeis pretos, 4 pixeis brancos
        $pontilhado = array($preto, $preto, $preto, $preto, $branco, $branco, $branco, $branco);

        //preenche imagem com cor branca
        imagefill($rifaBase, 0, 0, $branco);

        //////parte preenchivel
        //estilo da imagem
        imagesetstyle($rifaBase, $pontilhado);
        //desenha linha com estilo
        imageline($rifaBase, 170, 10, 170, 190, IMG_COLOR_STYLED);

        //textos de dados com linhas
        imagettftext($rifaBase, 10, 90, 40, 185, $preto, $fonte, 'Nome:');
        imageline($rifaBase, 40, 140, 40, 10, $preto);

        imagettftext($rifaBase, 10, 90, 70, 185, $preto, $fonte, 'Endereço:');
        imageline($rifaBase, 70, 120, 70, 10, $preto);
        imageline($rifaBase, 95, 180, 95, 10, $preto);

        imagettftext($rifaBase, 10, 90, 125, 185, $preto, $fonte, 'Telefone:');
        imageline($rifaBase, 125, 120, 125, 10, $preto);

        ///////parte da rifa
        imagettftext($rifaBase, 20, 0, 340, 30, $preto, $fonteNegrito, 'SORTEIO');

        imagettftext($rifaBase, 16, 0, 190, 100, $preto, $fonteNegrito, 'PRÊMIO');

        /////retangulo do premio
        //retangulo cinza
        imagerectangle($rifaBase, 290, 60, 630, 125, $cinza);
        //preenche com cor cinza
        imagefill($rifaBase, 301, 61, $cinza);
        //pega tamanho do texto do produto
        $produtoTamanho = tamanhoTexto($produto, 14, $fonte);
        //centraliza texto no retangulo
        imagettftext($rifaBase, 14, 0, (290 + (630 - 290) / 2) - ($produtoTamanho[0] / 2), 100, $preto, $fonte, $produto);

        //formata valor pra ter 2 espaços decimais
        imagettftext($rifaBase, 12, 0, 190, 180, $preto, $fonteNegrito, 'Valor: R$' . number_format((float) $valor, 2, ',', ''));
        imagettftext($rifaBase, 12, 0, 350, 180, $preto, $fonteNegrito, 'Data: ' . $data);

        for ($cont = 1; $cont <= $quantidade; $cont++) {
            //cria copia da base
            $rifa = imagecreate(650, 200);
            imagecopy($rifa, $rifaBase, 0, 0, 0, 0, 650, 200);

            //n da rifa na parte rasgavel
            imagettftext($rifa, 10, 90, 155, 55, $preto, $fonte, 'N° ' . $cont);
            //n da rifa no canto inferior direito
            imagettftext($rifa, 12, 0, 580, 180, $preto, $fonte, 'N° ' . $cont);

            //imagem pra base64
            ob_start();
            imagepng($rifa);
            $image_data = ob_get_contents();
            ob_end_clean();
            $image_data_base64 = base64_encode($image_data);

            //echo na imagem
            echo '<img src="data:image/png;base64,' . $image_data_base64 . '" />';
            echo '<br><br>';
        }
    }
}

//função retorna tamanho do texto em questão de pixels
//wid, hei
function tamanhoTexto($texto, $textoTamanho, $fonte)
{
    $box = imagettfbbox($textoTamanho, 0, $fonte, $texto);
    $min_x = min(array($box[0], $box[2], $box[4], $box[6]));
    $max_x = max(array($box[0], $box[2], $box[4], $box[6]));
    $min_y = min(array($box[1], $box[3], $box[5], $box[7]));
    $max_y = max(array($box[1], $box[3], $box[5], $box[7]));
    return array(($max_x - $min_x), ($max_y - $min_y));
}
