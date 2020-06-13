<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula Exemplo PHP</title>
</head>
<body>
    <h1>Exemplo PHP</h1>
     
     <form method="get" action="exemplo.php">
        <label for="nome">Produto a ser rifado</label><br>
        <input type="text" name="produto" placeholder="Insira o nome do produto"><br>
        <label for="quant">Quantidade de números a sortear</label><br>
        <input type="number" name="quant" min="1" placeholder="Insira a quantidade de números" ><br>
        <label for="data">Data do sorteio</label><br>
        <input type="date" name="data"><br>
        <label for="valor">Valor da Rifa</label><br>
        <input type="number" step="any" name="valor" min="0" placeholder="Insira o valor da rifa"><br>
        <input type="submit" value="Rodar o bagulho"><br>
     </form>

     
  
</body>
</html>