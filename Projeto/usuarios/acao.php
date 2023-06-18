<?php
$Tipo = $_GET['Tipo'];
$nomeusuario = $_GET['nomeusuario'];

@$conexao = pg_connect("host=localhost port=5432 dbname=curso user=postgres password=allanjoao"); //Linha de conexão
pg_set_client_encoding($conexao, 'UNICODE');

if ($Tipo == "ED"):
    $select = "SELECT pessoas.nomeusuario, pessoas.emailusuario, pessoas.senha
        FROM pessoas
        WHERE pessoas.nomeusuario = $nomeusuario";
    
    $resultado = pg_query($conexao, $select);
    while ($linha = pg_fetch_array($resultado)){
        $nomeusuario = $linha[0];
        $senhausuario = $linha[1];
        $emailusuario = $linha[2];

        echo "<script language='javascript'>
                window.parent.document.getElementById('nomeusuario').value='$nomeusuario';
                window.parent.document.getElementById('senhausuario').value='$senhausuario';
                window.parent.document.getElementById('emailusuario').value='$emailusuario';
            </script>";
    }
elseif ($Tipo == 'EX'):
    $delete = "DELETE FROM pessoas
        WHERE pessoas.nomeusuario = $nomeusuario"; echo $delete;
        
    pg_query($conexao, $delete);

    echo "<script language='javascript'>alert('Registro Excluído com Sucesso!');
        window.parent.listaRegistros();
        </script>";
endif;
?>