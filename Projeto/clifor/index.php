<!DOCTYPE html>
error_reporting(0);
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>

    <script language="javascript">
        function listaRegistros(){
            var url = 'listaRegistros.php';
            $.get(url, function (dataReturn) {
                $('#listaRegistros').html(dataReturn);
            });
        }
    </script>
</head>

<body>
<!--QUANDO FORMULARIO FOR SUBMETIDO GRAVA INFORMAÇÕES-->
<?php
error_reporting(0);
@$conexao = pg_connect("host=localhost port=5432 dbname=curso user=postgres password=allanjoao"); //Linha de conexão
pg_set_client_encoding($conexao, 'UNICODE');

//QUANDO FORMULARIO FOR SUBMETIDO GRAVA INFORMAÇÕES
if ($_POST) :
    $nome = $_POST["nome"];
    $tipousuario = $_POST["tipousuario"];
    $idusuario = $_POST["idusuario"];
    $cidadeusuario = $_POST["cidadeusuario"];
    $senhausuario = $_POST["senhausuario"];
        echo "<script language='javascript'>alert('Não conectou.');</script>";
    else:
        if ($idusuario == ''):
            $insert = "INSERT INTO pessoas (nome, emailusuario, senhausuario,cidadeusuario) 
            VALUES (UPPER('$nome'), '$emailusuario', '$cidadeusuario', '$senhausuario')";
        
            pg_query($conexao, $insert);

            echo "<script language='javascript'>alert('Registro Gravado com Sucesso!');</script>";
        else:
            $update = "UPDATE pessoas 
    SET nome = UPPER('$nome'), senhausuario = '$senhausuario', emailusuario = LOWER('$emailusuario') 
    WHERE nome = $nome";

        
            pg_query($conexao, $update);

            echo "<script language='javascript'>alert('Registro Atualizado com Sucesso!');</script>";
        endif;
    endif;
endif;
?>
<!--CABEÇALHO DA TELA-->
<div style="height:50px">
    <legend><font size="6" color="blue">Cadastro de Usuários</font></legend>
</div>

<!--CAIXA QUE EXECUTA A AÇÃO DOS BOTÕES EDITAR E EXCLUIR-->
<iframe name="acao" width="100%" height="100" frameborder="0" marginheight="0" marginwidth="0" scrolling="auto"></iframe>

<!--FORMULÁRIO PARA PREENCHIMENTO-->
<form id="acao" action="index.php" method="POST">
    <input type="hidden" id="nome" name="nome">
    <div style="height:30px">
        <label for="nome"><strong><u>Nome:</u></strong></label>
        <input type="text" id="nome" name="nome" placeholder="Digite o nome" maxlength="80" required>
    </div>

    <div style="height:30px">
        <label for="senhausuario"><strong><u>Senha:</u></strong></label>
        <input type="password" id="senhausuario" name="senhausuario" placeholder="Digite uma senha" maxlength="80" required>
    </div>

    <div style="height:30px">
        <label for="cidadeusuario"><strong><u>Cidade:</u></strong></label>
        <select id="cidadeusuario" name="cidadeusuario" required>
            <option value="" selected>Selecione...</option>
            <?php
            $select = "SELECT id_cidade, nome
                FROM cidades 
                ORDER BY nome";
            
            $resultado = pg_query($conexao, $select);
            while ($linha = pg_fetch_array($resultado)){
                $idcidade = $linha[0];
                $nomecidade = $linha[1];

                echo "<option value='$idcidade'>$nomecidade</option>";
            }
            ?>
        </select>
    </div>

    <div style="height:30px">
        <label for="emailusuario"><strong><u>E-mail:</u></strong></label>
        <input type="email" id="emailusuario" name="emailusuario" placeholder="Digite seu e-mail" maxlength="80" required>
    </div>

    <div style="height:30px">
        <button type="submit" name="btsalvar" id="btsalvar">SALVAR</button>
    </div>
    <div style="height:30px">
        <button type="button"><a href="../">Voltar</a></button>
    </div>
</form>

<!--LISTA DOS REGISTROS GRAVADOS NO BANCO-->
<div id="listaRegistros">
    <?php include "listaRegistros.php";?>
</div>
</body>
</html>

<script language="javascript">
    function AcaoUsuario(id, acao){
        window.open('acao.php?Tipo=' + acao + '&idusuario=' + id, 'acao');
    }
</script>