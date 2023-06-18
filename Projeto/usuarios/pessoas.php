<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes e Fornecedores</title>
</head>

<body>
<!--QUANDO FORMULARIO FOR SUBMETIDO GRAVA INFORMAÇÕES-->
<?php
@$conexao = pg_connect("host=localhost port=5432 dbname=curso user=postgres password=allanjoao"); //Linha de conexão
pg_set_client_encoding($conexao, 'UNICODE');

//QUANDO FORMULARIO FOR SUBMETIDO GRAVA INFORMAÇÕES
if ($_POST):
    $nomeusuario = $_POST["nomeusuario"];
    $tipousuario = $_POST["tipousuario"];

    if ($nomeusuario == ""){
        echo "<script language='javascript'>alert('Preenche o campo mané.');</script>";
    } else {
        if(!@$conexao):
            echo "<script language='javascript'>alert('Não conectou.');</script>";
        else:
            $insert = "INSERT INTO pessoas ( nome, senha, cidades, email, telefone, cpf_cnpj) 
                VALUES (UPPER('$nomeusuario'), '$tipousuario')";
            
            pg_query($conexao, $insert);

            echo "<script language='javascript'>alert('Registro Gravado com Sucesso!');</script>";
        endif;
    }
endif;
?>

<div style="height:50px">
    <legend><font size="6" color="blue">Cadastro de Clientes/Fornecedores</font></legend>
</div>
<form id="acao" action="index.php" method="POST">
    <div style="height:30px">
        <label for="nomeusuario"><strong><u>Nome:</u></strong></label>
        <input type="text" id="nomeusuario" name="nomeusuario" placeholder="Digite o nome" maxlength="80">
        <label for="senhausuario"><strong><u>senha:</u></strong></label>
        <input type="text" id="senhausuario" name="senhausuario" placeholder="Digite a senha" maxlength="80">
    </div>

    <div style="height:30px">
        <label for="tipousuario"><strong>Tipo:</strong></label>
        <select id="tipousuario" name="tipousuario">
            <option value="A" selected>Ambos</option>
            <option value="C">Cliente</option>
            <option value="F">Fornecedor</option>
        </select>
    </div>

    <div style="height:30px">
        <button type="submit" name="btsalvar" id="btsalvar">SALVAR</button>
    </div>
    <div style="height:30px">
        <button type="button"><a href="../">Voltar</a></button>
    </div>
</form>
<table width="50%" border="1">
    <thead>
        <th>Nome</th>
        <th>Tipo</th>
        <th>cidade</th>
    </thead>
    <tbody>
        <?php
        $select = "SELECT pessoas, nomeusuario, id_cidade, senha, email
            FROM pessoas";
        
        $resultado = pg_query($conexao, $select);
        while ($linha = pg_fetch_array($resultado)){
            $idclifor = $linha[0];
            $nomeclifor = $linha[1];
            $tipoclifor = $linha[2];

            if($tipoclifor == 'A'):
                $clifortipo = "AMBOS";
            elseif($tipoclifor == 'C'):
                $clifortipo = "CLIENTE";
            else: 
                $clifortipo = "FORNECEDOR";
            endif;
            ?>
    <tr>
        <td><?php echo $nomeclifor;?></td>
        <td align="center"><?php echo $clifortipo;?></td>
    </tr>
            <?php
        }
        ?>
    </tbody>
</table>
</body>
</html>
</script>