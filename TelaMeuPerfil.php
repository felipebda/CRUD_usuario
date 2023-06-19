<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Meu Perfil</title>
</head>
<body>
    <?php
        #Variaveis globais relevantes
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

        //#1 - FAZER CONEXAO COM BANCO DE DADOS
        try
        {
            $pdo = new PDO("mysql:dbname=check_pet;host=localhost","root","123456");
        }
        catch(PDOException $e)
        {
            echo "Erro ao conectar com banco de dados: ".$e.getMessage();
        }

        //#2 - FAZER CADASTRO DE UM NOVO USUARIO
        
        if(isset($_POST["tipo_query"]))
        {
            if($_POST["tipo_query"] == "criar")
            {
                
                $nome = $_POST["nome"];
                echo $nome;
                $email = $_POST["email"];
                $senha = $_POST["senha"];

                $query = $pdo->prepare("INSERT INTO usuario(nome, email, senha) VALUES(:n, :e, :s)");
                $query->bindValue(":n", $nome);
                $query->bindValue(":e",$email);
                $query->bindValue(":s",$senha);

                $query->execute();

                //AQUIIIIIII
                $query5 = $pdo->prepare("SELECT * FROM usuario WHERE email = :e AND senha = :s");
                $query5->bindValue(":e", $email);
                $query5->bindValue(":s", $senha);

                $query5->execute();
                $lista3 = $query5->fetchAll(PDO::FETCH_ASSOC);

                $id = $lista3[0]["id_usuario"];
                $nome = $lista3[0]['nome'];
                $email = $lista3[0]['email'];
                $senha = $lista3[0]['senha'];
                $cpf = $lista3[0]['cpf'];
                $data_nascimento = $lista3[0]['data_nascimento'];
                $sexo = $lista3[0]['sexo'];
                $cidade = $lista3[0]['cidade'];
                $endereco =$lista3[0]['endereco'];
                $complemento = $lista3[0]['complemento'];
            }

            //#3 - Pegar as informacoes na tela de LOGIN
            

            if($_POST["tipo_query"] == "leitura")
            {
                $email = $_POST["email"];
                $senha = $_POST["senha"];
                $query2 = $pdo->prepare("SELECT * FROM usuario WHERE email = :e AND senha = :s");
                $query2->bindValue(":e", $email);
                $query2->bindValue(":s", $senha);

    
                $query2->execute();
                $lista = $query2->fetchAll(PDO::FETCH_ASSOC);
                //print_r($lista)."<br>";
                //var_dump($lista);

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

            if($_POST["tipo_query"] == "atualizar")
            {
                $id = intval($_POST["id_usuario"]);
                $cpf = $_POST['cpf'];
                $data_nascimento = $_POST['data_nascimento'];
                $sexo = $_POST['sexo'];
                $cidade = $_POST['cidade'];
                $endereco = $_POST['endereco'];
                $complemento = $_POST['complemento'];


                $query3 = $pdo->prepare("UPDATE usuario SET cpf = :c, data_nascimento = :d, sexo = :s, cidade = :ci, endereco = :e, complemento = :co WHERE id_usuario = :id");

                $query3->bindValue(":id", $id);
                $query3->bindValue(":c", $cpf);
                $query3->bindValue(":d", $data_nascimento);
                $query3->bindValue(":s", $sexo);
                $query3->bindValue(":ci", $cidade);
                $query3->bindValue(":e", $endereco);
                $query3->bindValue(":co", $complemento);

                $query3->execute();

                $query4 = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = $id");
                $query4->execute();

                $lista2 = $query4->fetchAll(PDO::FETCH_ASSOC);

                $id = $lista2[0]["id_usuario"];
                $nome = $lista2[0]['nome'];
                $email = $lista2[0]['email'];
                $senha = $lista2[0]['senha'];
                $cpf = $lista2[0]['cpf'];
                $data_nascimento = $lista2[0]['data_nascimento'];
                $sexo = $lista2[0]['sexo'];
                $cidade = $lista2[0]['cidade'];
                $endereco =$lista2[0]['endereco'];
                $complemento = $lista2[0]['complemento'];
                
            }


            
        }



    ?>


    <h1>Meu Perfil</h1>
    <br>

    <h2>Dados Cadastrais</h2>
    <p>Nome Completo: <?php echo $nome; ?></p>
    <p>E-mail: <?php echo $email; ?></p>
    <p>CPF: <?php echo $cpf ?></p>
    <p>Sexo: <?php echo $sexo; ?></p>
    <p>Data de Nascimento: <?php echo $data_nascimento ?></p>
    <p>Cidade: <?php echo $cidade ?></p>
    <p>Endereco: <?php echo $endereco ?></p>
    <p>Complemento: <?php echo $complemento ?></p>
    <br><br>
    <a href=""><button>Meus Pets</button></a>
    
    <form action="TelaGerenciarCadastro.php" method="post">
        <input type="hidden" name="id_utilizado" value="<?php echo $id; ?>">
        <input type="submit" value="Gerenciar Cadastro">
    </form>

</body>
</html>