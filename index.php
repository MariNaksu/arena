
<?php
include "conexao.php";
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nickname = $_POST["nickname"];

    $nome_completo = $_POST["nome_completo"];

    $email = $_POST["email"];

    $telefone = $_POST["telefone"];

    $usuario_do_discord = $_POST["usuario_do_discord"];

    $cidade = $_POST["cidade"];

    $plataforma_e_jogo = $_POST["plataforma_e_jogo"];



   $sql = "INSERT INTO jogadores (`nickname`, `nome completo`, `email`, `telefone`, `Usuário do Discord`, `cidade`, `Plataforma e jogo`) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
         die("Erro na consulta SQL: " . $conexao->error);
}




$stmt->bind_param(
    "sssssss",
    $nickname,
    $nome_completo,
    $email,
    $telefone,
    $usuario_do_discord,
    $cidade,
    $plataforma_e_jogo
);
    if ($stmt->execute()) {
        $mensagem = "<div class='alerta-sucesso'><h3>Inscrição realizada com sucesso!</h3><p><strong>Nome:</strong> " . htmlspecialchars($nome_completo) . "</p><p><strong>E-mail:</strong> " . htmlspecialchars($email) . "</p><p><strong>Nickname:</strong> " . htmlspecialchars($nickname) . "</p></div>";
    } else {
        if ($stmt->errno == 1062) {
            $mensagem = "<div class='alerta-erro'><h3>Este e-mail já está cadastrado!</h3></div>";
        } else {
            $mensagem = "<div class='alerta-erro'><h3>Erro ao realizar inscrição: " . htmlspecialchars($stmt->error) . "</h3></div>";
        }
    }
    $stmt->close();
    $conexao->close();
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copa arena</title>
    <style>
        body {

            background-color: #0b0b0e;
            background-image: linear-gradient(rgba(11, 11, 14, 0.85), rgba(11, 11, 14, 0.85)), url('imagens/roxeeverde.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 40px 20px;
            box-sizing: border-box; }

        .container {
            background-color: rgba(20, 20, 27, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(130, 87, 229, 0.3);
            width: 100%;
            max-width: 400px;
            border-top: 4px solid #00ff88;
            border-bottom: 4px solid #8257e5;
            text-align: center;
            backdrop-filter: blur(10px);
            margin-bottom: 30px;
        }
        h2 {
            margin-bottom: 25px;
            color: #00ff88;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 0 0 10px rgba(0, 255, 136, 0.3);
        }

        .campo-grupo {
            margin-bottom: 18px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: #a8a8b3;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 2px solid #29292e;
            background-color: #0b0b0e;
            color: #fff;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #8257e5;
            box-shadow: 0 0 8px rgba(130, 87, 229, 0.5); }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 6px;
            background-color: #8257e5;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(130, 87, 229, 0.3);
        }

        button:hover {
            background-color: #00ff88;
            color: #0b0b0e;
            box-shadow: 0 0 15px rgba(0, 255, 136, 0.6);
        }

        .alerta-sucesso {
            background-color: rgba(0, 255, 136, 0.1);
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #00ff88;
            margin-bottom: 20px;
            text-align: left;
        }

        .alerta-sucesso h3 {
            color: #00ff88;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .alerta-sucesso p {
            margin: 5px 0;
            font-size: 14px;
        }

        .alerta-erro {
            background-color: rgba(255, 51, 51, 0.1);
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #ff3333;
            margin-bottom: 20px;
        }

        .alerta-erro h3 {
            color: #ff3333;
            margin: 0;
            font-size: 16px;
        }

        .rodape-campeonato {
            width: 100%;
            max-width: 900px;
            background-color: rgba(20, 20, 27, 0.95);
            border-radius: 8px;
            padding: 20px;
            box-sizing: border-box;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 20px rgba(0, 255, 136, 0.1);
        }


        .tabela-games {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .tabela-games td {
            padding: 10px;
            width: 33.33%;
            border: none;
        }

        .tabela-games img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .tabela-games img:hover {
            transform: scale(1.03);
        }





    </style>
</head>
<body>

    <div class="container">
        <h2>Inscrição Hackathon</h2>
        <?php echo $mensagem; ?>

        <form action="index.php" method="POST">
            <div class="campo-grupo">
                <label>Insira seu Nickname:</label>
                <input type="text" name="nickname" required>
            </div>

            <div class="campo-grupo">
                <label>Insira seu Nome Completo:</label>
                <input type="text" name="nome_completo" required>
            </div>

            <div class="campo-grupo">
                <label>Insira seu E-mail:</label>
                <input type="email" name="email" required>
            </div>

            <div class="campo-grupo">
                <label>Insira seu Telefone:</label>
                <input type="tel" name="telefone" required>
            </div>

            <div class="campo-grupo">
                <label>Insira seu Usuário do Discord:</label>
                <input type="text" name="usuario_do_discord" required>
            </div>

            <div class="campo-grupo">
                <label>Insira sua Cidade:</label>
                <input type="text" name="cidade" required>
            </div>

            <div class="campo-grupo">
                <label>Insira sua Plataforma e Jogo:</label>
                <input type="text" name="plataforma_e_jogo" placeholder="Ex: PC - Valorant" required>
            </div>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
    ]



    <div class="rodape-campeonato">
        <table class="tabela-games">
            <tr>
                <td><img src="imagens/valorant.jpg" alt="Valorant"></td>
                <td><img src="imagens/lol.jpg" alt="League of Legends"></td>
                <td><img src="imagens/ea.jpg" alt="EA FC"></td>
            </tr>
        </table>
    </div>
</body>
</html>