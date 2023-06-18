<table width="100%" border="1">
    <thead>
        <th>Nome</th>
        <th>Cidade</th>
        <th>E-mail</th>
        <th colspan="2">Ações</th>
    </thead>
    <tbody>
        <?php
        $select = "SELECT  pessoas.nomeusuario, pessoas.emailusuario, pessoas.senhausuario
            FROM pessoas INNER JOIN cidades ON cidades.id_cidade = cidades.id_cidade 
            ORDER BY pessoas.nomeusuario";
        
        $resultado = pg_query($conexao, $select);
        while ($linha = pg_fetch_array($resultado)){
            $nomeusuario = $linha[0];
            $senhausuario = $linha[1];
            $emailusuario = $linha[2];
            ?>
    <tr>
        <td><?php echo $nomeusuario;?></td>
        <td><?php echo $cidadeusuario;?></td>
        <td><?php echo $emailusuario;?></td>
        <td width="10%" align="center"><a href="#" onclick="AcaoUsuario(<?php echo $idusuario;?>, 'EX')">Excluir</a></td>
        <td width="10%" align="center"><a href="#" onclick="AcaoUsuario(<?php echo $idusuario;?>, 'ED')">Editar</a></td>
    </tr>
            <?php
        }
        ?>
    </tbody>
</table>