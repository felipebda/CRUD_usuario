<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <?php
    //Variaveis globais
        $id = 0;
        $nome = "";
        $email = "";
        $senha = "";
        $cpf = "";
        $data_nascimento = "";
        $sexo = "";
        $cidade = "";
        $endereco = "";
        $complemento = "";

        //# 4 Pegar dados para atualizar cadastro
        if(isset($_POST['id_utilizado']))
        {
            $id =  intval($_POST['id_utilizado']);
            //var_dump ($id);

            //FAZER CONEXAO COM BANCO DE DADOS
            try
            {
                $pdo = new PDO("mysql:dbname=check_pet;host=localhost","root","123456");
            }
            catch(PDOException $e)
            {
                echo "Erro ao conectar com banco de dados: ".$e.getMessage();
            }


            $query = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = :i");
            $query->bindValue(":i", $id);
            $query->execute();

            $lista = $query->fetchAll(PDO::FETCH_ASSOC);

            $id = $lista[0]["id_usuario"];
            $nome = $lista[0]['nome'];
            $email = $lista[0]['email'];
            $senha = $lista[0]['senha'];
            $cpf = $lista[0]['cpf'];
            $data_nascimento = $lista[0]['data_nascimento'];
            $sexo = $lista[0]['sexo'];
            $cidade = $lista[0]['cidade'];
            $endereco =$lista[0]['endereco'];
            $complemento = $lista[0]['complemento'];
        }

    ?>





    <div>
        <h2>Complete seu Cadastro</h2>
        <form action="TelaMeuPerfil.php" method="POST">
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" value = "<?php echo $cpf; ?>">
            <br>
            <label for="data">Data de Nascimento</label>
            <input type="text" id="data" name="data_nascimento" value = "<?php echo $data_nascimento; ?>">
            <br>
            <label for="sexo">Sexo</label>
            <input type="text" is="sexo" name="sexo" value = "<?php echo $sexo; ?>">
            <br>
            <label for="cidade">Cidade</label>
            <input type="text" id="cidade" name="cidade" value = "<?php echo $cidade; ?>">
            <br>
            <label for="endereco">Endereco</label>
            <input type="text" id="endereco" name="endereco" value = "<?php echo $endereco; ?>">
            <br>
            <label for="complemento">Complemento</label>
            <input type="text" id="complemento" name="complemento" value = "<?php echo $complemento; ?>">
            <br>
            <input type="hidden" name="id_usuario" value="<?php echo $id; ?>">
            <input type="hidden" name="tipo_query" value="atualizar">
            <input type="submit" value="Salvar">
            <br>
        </form>
    </div>

    <div>
        <button>FAQS</button>
        <button>Contate-nos</button>
        <button>Suporte</button>
        <button>Sair do perfil</button>
        <form action="TelaLogin.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="tipo_query" value ="deletar">
            <input type="submit" value="Deletar Perfil">
        </form>

    </div>
</body>
</html>