<?php require_once("conexao.php"); ?>
<?php
    //iniciar variavel de sessao
    session_start();

    if(isset($_POST["usuario"])){
        $usuario = $_POST["usuario"];
        $senha    = $_POST["senha"];

        //echo $ususario."<br>".$senha;
        $login = "SELECT * FROM clientes WHERE usuario = '{$usuario}' and senha = '{$senha}' ";
       
        //conecta o banco de dados e a variavel(pesquisa)
        $acesso = mysqli_query($conecta,$login);
        //avisar caso de error no banco de dados
        if(!$acesso){
            die("Falha na consulta ao banco");
        }

        $informacao = mysqli_fetch_assoc($acesso);

        //verifica se existe o usuario no banco de dados 
        if(empty($informacao)){
            $mensagem = "Login sem sucesso";
        }else{
            $_SESSION["user_portal"] = $informacao["clienteID"];
            header("location:listagem.php");
        }
    } 
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CRUD Uninassau</title>
        
        <!-- estilo -->
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/images.css">
    
        
    </head>

    <body>
    
       
        <main> 

                <div id="janela_login">
                   <form action="index.php" method="post">
                        <h2>Login</h2>
                        <input type="text" name="usuario" placeholder="Usuário">
                        <input type="password" name="senha" placeholder="Senha">
                        <input type="submit" value="Login" >
                        <!-- caso de error no login dispara a mensagem de login sem sucesso -->
                        <?php 
                            if(isset($mensagem)){
                        ?>
                        <p><?php echo $mensagem?> </p>
                        <?php
                            }
                        ?>
                   </form> 
                </div>
        </main>

         
    </body>
</html>



<?php
    // Fechar conexao
    mysqli_close($conecta);
?>