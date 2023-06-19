<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Login</title>
</head>
<body>

<div>
    <h2>Ainda nao possue conta?</h2>
    <p>Crie sua conta agora mesmo</p>
    <a href="TelaCadastro.php"><button>Registre-se</button></a>
    <br>
</div>

<div>
    <?php  
        //CRIANDO PDO

        try
        {
            $pdo = new PDO("mysql:dbname=check_pet;host=localhost","root","123456");
        }
        catch(PDOException $e)
        {
            echo "Erro ao conectar com banco de dados: ".$e.getMessage();
        }

        //CONFIRMAR A EXCLUSAO DA CONTA

        if(isset($_POST["tipo_query"]))
        {
            $id = intval($_POST["id"]);
            //var_dump($id);

            $query5 = $pdo->prepare("DELETE FROM usuario WHERE id_usuario = $id");
            $query5->execute();
        }

    

    ?>



    <h2>Digite seu Login</h2>
    <p>Preencha seus dados</p>
    <form action="TelaMeuPerfil.php" method="POST">
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email">
        <br>
        <label for="senha">Senha</label>
        <input type="text" id="senha" name="senha">
        <br>
        <input type="hidden" name="tipo_query" value="leitura">
        <input type="submit" value="Entrar">
    </form>
</div>
    
</body>
</html>