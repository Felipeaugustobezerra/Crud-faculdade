<?php require_once("conexao.php"); ?>
<?php
    // tabela de transportadoras
    $tr = "SELECT * FROM transportadoras ";
    $consulta_tr = mysqli_query($conecta, $tr);
    if(!$consulta_tr) {
        die("erro no banco");
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CRUD Uninassau</title>
        
        <!-- estilo -->
        <link rel="stylesheet" href="css/listagem.css">

    </head>

    <body>
        <main>  
            <nav>
                <a href="inserir.php">Inserir Transportadora</a>
            </nav>
            
        
                
            <div id="janela_transportadoras">
            
                <?php
                    while($linha = mysqli_fetch_assoc($consulta_tr)) {
                ?>
                <ul>
                    <li><?php echo $linha["nometransportadora"] ?></li>
                    <li><?php echo $linha["cidade"] ?></li>
                    <li><a class="alterar" href="alteracao.php?codigo=<?php echo $linha["transportadoraID"] ?>">Alterar</a> </li>
                    <li><a class="excluir" href="exclusao.php?codigo=<?php echo $linha["transportadoraID"] ?>">Excluir</a> </li>
                </ul>
                <?php
                    }
                ?>
            </div>
        </main>

          
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>