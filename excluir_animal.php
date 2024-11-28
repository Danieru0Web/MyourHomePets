<?php
include 'conection_DB.php'; // Inclui a conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num_animal = $_POST['num_animal'];

    // Prepara a query de exclusão
    $stmt = $mysqli->prepare("DELETE FROM animais WHERE num_animal = ?");
    $stmt->bind_param("i", $num_animal);

    if ($stmt->execute()) {
        // Redireciona para a página com a lista de animais após a exclusão
        header("Location: paginaOng.php");
        exit();
    } else {
        echo "Erro ao excluir o animal.";
    }

    $stmt->close();
}

$mysqli->close();
?>
