<?php
session_start();

// Verifica se a sessão do usuário está ativa
if (isset($_SESSION["user_id"])) {
    // Inclui o arquivo de conexão com o banco de dados
    $mysqli = require __DIR__ . "/conection_DB.php";

    // Verifica se a conexão foi estabelecida com sucesso
    if (!$mysqli) {
        die("Erro ao conectar ao banco de dados.");
    }

    // Busca as informações do usuário logado
    $sql = "SELECT * FROM usuarios WHERE id_usuario = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylePaginaOng.css">
    <title>Myour Home Pet's Doações</title>
</head>
<body>
    <header>
        <h1>Myour Home Pet's Doações</h1>
        <div class="buttons">
            <?php if (isset($user)): ?>
                <p>Bem-vindo <?= htmlspecialchars($user["nome"]) ?></p>
                <p><a href="logout.php">Sair</a></p>
            <?php else: ?>
                <p><a href="login.php">Login</a> ou <a href="OngCadastrar.php">Cadastre-se</a></p>
            <?php endif; ?>
            <button type="button" onclick="window.location.href='cadastrarNovoPets.php'">Cadastrar animais</button>
        </div>
    </header>

    <main>
        <?php
        // Consulta os animais cadastrados
        $sql = "SELECT * FROM animais WHERE nome != ''";
        $result = $mysqli->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($animal = $result->fetch_assoc()) {
                echo '<section class="animal">';
                if (!empty($animal['imagem'])) {
                    echo '<img src="uploads/' . htmlspecialchars($animal['imagem']) . '" alt="' . htmlspecialchars($animal['nome']) . '">';
                } else {
                    echo '<img src="placeholder.jpg" alt="Imagem não disponível">';
                }
                echo '<h2>Nome: ' . htmlspecialchars($animal['nome']) . '</h2>';
                echo '<p>Idade: ' . htmlspecialchars($animal['idade']) . '</p>';
                echo '<p>Tamanho: ' . htmlspecialchars($animal['tamanho']) . '</p>';
                echo '<p>Peso: ' . htmlspecialchars($animal['peso']) . '</p>';
                echo '<p>Cor: ' . htmlspecialchars($animal['cor']) . '</p>';
                echo '<p>Tipo: ' . htmlspecialchars($animal['tipo']) . '</p>';
                echo '<p>Contato: ' . htmlspecialchars($animal['contato']) . '</p>';
                echo '<p>Descrição: ' . htmlspecialchars($animal['descricao']) . '</p>';
                
                // Adiciona o botão "Excluir"
                echo '<button style="background-color: orange; color: white; padding: 10px; border: none; cursor: pointer; margin-top: 10px;" onclick="excluirAnimal(' . $animal['id_animal'] . ')">Excluir</button>';
                
                echo '</section>';
            }
        } else {
            echo "<p>Nenhum animal cadastrado para adoção ainda.</p>";
        }

        $mysqli->close();
        ?>
    </main>
</body>
</html>

<script>
function excluirAnimal(id) {
    if (confirm('Tem certeza que deseja excluir este animal?')) {
        window.location.href = 'excluirAnimal.php?id=' + id;
    }
}
</script>
