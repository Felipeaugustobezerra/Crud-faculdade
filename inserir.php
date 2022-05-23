<?php require_once("conexao/conexao.php"); ?>
<?php
    //insercao no banco teste 
    if(isset($_POST["cidade"])) { 
        $nome       = $_POST["nometransportadora"];
        $endereco   = $_POST["endereco"];
        $cidade     = $_POST["cidade"];
        $estado     = $_POST["estados"];
        $cep        = $_POST["cep"];
        $cnpj       = $_POST["cnpj"];
        $telefone   = $_POST["telefone"];
        
        
        // print_r($_POST);

        $inserir =" INSERT INTO transportadoras ";
        $inserir.=" (nometransportadora, endereco, telefone, cidade, estadoID, cep, cnpj) ";
        $inserir.=" VALUES ('$nome','$endereco','$telefone','$cidade',$estado,'$cep','$cnpj') ";

        $operacao_inserir = mysqli_query($conecta,$inserir);
        if(!$operacao_inserir){
            die("Falha na inserçao de dados");
        }else{
            header("Location:listagem.php");
        }
    }


    //SELECAO DE ESTADOS
    //scrip do banco de dados 
     $estados = "SELECT nome,estadoID FROM estados";
     //conexao entre o banco de dados e a variavel com script
     $linha_estados = mysqli_query($conecta,$estados);
     //verificar se nao ha erros na busca
     if(!$linha_estados){
         die("Falha no banco de dados");
     }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CRUD Uninassau</title>
        
        <!-- estilo -->
        <link rel="stylesheet" href="css/inserir.css">
    </head>

    <body>
        <main>  
            <div id="janela_formulario">
                <form action="inserir.php" method="post">
                    <h2>Inserir Transportadora</h2>
                    <label for="nometransportadora">Nome da Transportadora</label>
                    <input type="text" name="nometransportadora" placeholder="Nome da Transportadora"> 
                    
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" placeholder="Endereco"> 
                    
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" placeholder="Cidade">

                    <label for="estados">Estados</label>
                    <select name="estados">
                        <?php 
                            //loop para pesquisar todos os dados dos estados
                            while($linha = mysqli_fetch_assoc($linha_estados)) { ?>
                                 <option value="<?php echo $linha["estadoID"]; ?>">
                                <!-- exibicao dos estados -->
                                <?php echo $linha["nome"]; ?>
                                </option>
                        <?php } ?>
                    </select> 
                   
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" placeholder="Telefone"> 
                    
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" placeholder="CEP"> 
                    
                    <label for="cnpj">CNPJ</label>
                    <input type="text" name="cnpj" placeholder="CNPJ"> 

                    <input type="submit" value="Inserir"> 
                    
                </form>
            </div>
        </main>

        
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>