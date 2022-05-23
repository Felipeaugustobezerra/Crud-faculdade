<?php require_once("conexao/conexao.php"); ?>
<?php 
    //exluir transportadora,usando o metodo post para verificar qualquer campo do formulario
    if(isset($_POST["nometransportadora"])){
        $tid = $_POST["transportadoraID"];

        $exclusao = "DELETE FROM transportadoras WHERE transportadoraID = {$tid}";
        $consulta_exclusao = mysqli_query($conecta,$exclusao);
        if(!$consulta_exclusao){
            die("Falha na exclusao de transportadora");
        }else{
            header("location:listagem.php");
        }
    }

    //verificar se existe a variavel "codigo" na url,usando get para pegar esse codigo e consulta o banco de dados
    if(isset($_GET["codigo"])){
        $id = $_GET["codigo"];
        $tr = "SELECT * FROM transportadoras WHERE transportadoraID = {$id}";

        $consulta_transportadora = mysqli_query($conecta,$tr);
        if(!$consulta_transportadora){
            die("Falha no banco de exclusao");
        }
    }else{
        header("Location:listagem.php");
    }
    $info_transportadora = mysqli_fetch_assoc($consulta_transportadora);
    //print_r($info_transportadora);

    // consulta aos estados
    $estados = "SELECT * ";
    $estados .= "FROM estados ";
    $lista_estados = mysqli_query($conecta,$estados);
    if(!$lista_estados) {
       die("erro no banco"); 
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CRUD Uninassau</title>
        
        <!-- estilo -->
        <link rel="stylesheet" href="css/exclusao.css">
    </head>

    <body>
        <main>  
            <div id="janela_formulario">
            <form action="exclusao.php" method="post">
                    <h2>Exclusao de Transportadoras</h2>
                    
                    <label for="nometransportadora">Nome da Transportadora</label>
                    <input type="text" value="<?php echo $info_transportadora["nometransportadora"]  ?>" name="nometransportadora" id="nometransportadora">

                    <label for="endereco">Endereço</label>
                    <input type="text" value="<?php echo $info_transportadora["endereco"]  ?>" name="endereco" id="endereco">
                    
                    <label for="cidade">Cidade</label>
                    <input type="text" value="<?php echo $info_transportadora["cidade"]  ?>" name="cidade" id="cidade">
                    
                    <label for="estados">Estados</label>
                    <select type="text" name="estados"> 
                        <?php 
                            $meuestado = $info_transportadora["estadoID"];
                            while($linha = mysqli_fetch_assoc($lista_estados)) {
                                $estado_principal = $linha["estadoID"];
                                if($meuestado == $estado_principal) {
                        ?>
                            <option value="<?php echo $linha["estadoID"] ?>" selected>
                                <?php echo $linha["nome"] ?>
                            </option>
                        <?php
                                } else {
                        ?>
                            <option value="<?php echo $linha["estadoID"] ?>" >
                                <?php echo $linha["nome"] ?>
                            </option>                        
                        <?php 
                                }
                            }
                        ?>
                    </select>             

                    <input type="hidden" name="transportadoraID" value="<?php echo $info_transportadora["transportadoraID"] ?>">
                    <input type="submit" value="Confirmar Exclusão">                    
                </form>   

            </div>
        </main>

        
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>