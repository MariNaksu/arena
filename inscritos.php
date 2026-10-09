
<?php
include "conexao.php";

$sql = "SELECT `nickname`, `nome completo`, `Plataforma e jogo` FROM jogadores";
$resultado = $conexao->query($sql);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogadores Inscritos - Copa Arena</title>
</head>
<body style="background-color: #121214; color: #ffffff; font-family: sans-serif; padding: 40px; box-sizing: border-box;">

    <div style="background-color: #1e1e24; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); max-width: 800px; margin: 0 auto;">

        <h2 style="color: #7d3dcc; margin-top: 0; margin-bottom: 25px;">Jogadores Inscritos</h2>

        <?php
        if ($resultado && $resultado->num_rows > 0) {
            echo "<table style='width: 100%; border-collapse: collapse; text-align: left;'>";
            echo "<tr>
                    <th style='padding: 12px; border-bottom: 1px solid #444;'>Nickname</th>
                    <th style='padding: 12px; border-bottom: 1px solid #444;'>Nome completo</th>
                    <th style='padding: 12px; border-bottom: 1px solid #444;'>Plataforma e jogo</th>
                  </tr>";

            while ($jogador = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td style='padding: 12px; border-bottom: 1px solid #333;'>" . htmlspecialchars($jogador["nickname"]) . "</td>";
                echo "<td style='padding: 12px; border-bottom: 1px solid #333;'>" . htmlspecialchars($jogador["nome completo"]) . "</td>";
                echo "<td style='padding: 12px; border-bottom: 1px solid #333;'>" . htmlspecialchars($jogador["Plataforma e jogo"]) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p style='color: #a8a8b3;'>Nenhum jogador inscrito no momento.</p>";
        }

        $conexao->close();
        ?>

    </div>

</body>
</html>