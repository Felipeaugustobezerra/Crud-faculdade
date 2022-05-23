<?php require_once("conexao/conexao.php");?>

<?php
    if (isset($_POST["cidade"])){
        // print_r($_POST);
        $nome       = $_POST["nometransportadora"];
        $endereco   = $_POST["endereco"];
        $cidade     = $_POST["cidade"];
        $estado     = $_POST["estados"];
        $cep        = $_POST["cep"];
        $cnpj       = $_POST["cnpj"];
        $telefone   = $_POST["telefone"];
        $tid        = $_POST["transportadoraID"];

        //Objeto de Alteracao
        $alterar     = "UPDATE transportadoras ";
        $alterar     .=" SET ";
        $alterar     .=" nometransportadora = '{$nome}', ";
        $alterar     .=" endereco = '{$endereco}', ";
        $alterar     .=" cidade = '{$cidade}', ";
        $alterar     .=" estadoID = {$estado}, ";
        $alterar     .=" cep = '{$cep}', ";
        $alterar     .=" cnpj = '{$cnpj}', ";
        $alterar     .=" telefone = '{$telefone}' ";
        $alterar     .=" WHERE  transportadoraID = {$tid} ";
       
        $operacao_alteracao = mysqli_query($conecta,$alterar);
        if(!$operacao_alteracao){
            die("Falha na inserçao de dados");
        }else{
             header("Location:listagem.php");
        }
    
    }


    //consulta a tabela de trasnportadora 
    $transp = "SELECT * FROM transportadoras ";
    if(isset($_GET["codigo"])){
        $id = $_GET["codigo"];
        $transp .= " WHERE transportadoraID = {$id}";
    }else{
        $transp .= " WHERE transportadoraID = 1 ";
    }
    $con_transp = mysqli_query($conecta,$transp);
    if(!$con_transp){
        die("Erro no banco de dados");
    }else{
        $info_transp = mysqli_fetch_assoc($con_transp);
    }

    //consulta tabela de Estados
    $estados = "SELECT estadoID, nome FROM estados ";
    $lista_estados = mysqli_query($conecta,$estados);
    if(!$lista_estados){
        die("Falha no banco");
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CRUD Uninassau</title>
        
        <!-- estilo -->
       <link rel="stylesheet" href="css/alteracao.css">
    </head>

    <body>
        
        <main>  
        <div id="janela_formulario">
                <form action="alteracao.php" method="post">
                    <h2>Alterar Transportadora</h2>
                    <label for="nometransportadora">Nome Transportadora</label>
                    <input type="text" value="<?php echo $info_transp["nometransportadora"]?>" name="nometransportadora">

                    <label for="endereco">Endereço</label>
                    <input type="text" value="<?php echo $info_transp["endereco"]?>" name="endereco">

                    <label for="cidade">Cidade</label>
                    <input type="text" value="<?php echo $info_transp["cidade"]?>" name="cidade">

                    <label for="estados">Estados</label>
                    <select type="text" name="estados">
                        <?php 
                            $meuestado = $info_transp["estadoID"];
                            while($linha = mysqli_fetch_assoc($lista_estados)) {
                                $estado_momento = $linha["estadoID"];
                                if($meuestado == $estado_momento) {     
                        ?>
                            <option value="<?php echo $linha["estadoID"];?> " selected >
                                <?php echo $linha["nome"];?>
                            </option>
                        <?php
                            } else {
                        ?>
                        <option value="<?php echo $linha["estadoID"];?> ">
                            <?php echo $linha["nome"];?>
                        </option>
                        <?php 
                                }
                            }
                        ?>
                    </select>    

                    <label for="cep">CEP</label>
                    <input type="text" value="<?php echo $info_transp["cep"]?>" name="cep">

                    <label for="telefone">Telefone</label>
                    <input type="text" value="<?php echo $info_transp["telefone"]?>" name="telefone">

                    <label for="cnpj">CNPJ</label>
                    <input type="text" value="<?php echo $info_transp["cnpj"]?>" name="cnpj">

                    <input type="hidden" name="transportadoraID" value="<?php echo $info_transp["transportadoraID"]?>">

                    <input type="submit" value="Confirmar Alteraçao">

                </form>
            </div>
        </main>

         
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>