<?php
$email = $_POST["email"];
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expire = date("Y-m-d H:i:s", time() + 60 * 30);
$mysqli = require __DIR__ . "/conection_DB.php";

// Atualiza o token e a data de expiração no banco de dados
$sql = "UPDATE usuarios
        SET reset_token_hash = ?, expire_token_at = ?
        WHERE email = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sss", $token_hash, $expire, $email);
$stmt->execute();

// Verifica se a atualização foi bem-sucedida e envia o e-mail de redefinição
if ($stmt->affected_rows) {
    require __DIR__ . "/mailer.php";
    $mail->setFrom("petsmyourhome@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Redefinir Senha";
    $mail->isHTML(true); // Permite HTML no corpo do e-mail
    $mail->Body = <<<END
        Clique <a href="http://localhost/myourhome/reset_password.php?token=$token">aqui</a>
        para redefinir a sua senha.
    END;
    try {
        $mail->send();
        $message = "Mensagem enviada, verifique o seu inbox.";
    } catch (Exception $e) {
        $message = "Email não pode ser enviado. Erro Mailer: {$mail->ErrorInfo}";
    }
} else {
    $message = "Nenhum usuário encontrado com esse e-mail.";
}

$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
    <style>
        /* Estilos básicos para a página */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #fdfcdc;
            margin: 0;
        }

        /* Estilo do card */
        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }

        .card p {
            margin: 0 0 20px;
            color: #333;
        }

        .card button {
            padding: 10px 20px;
            background-color: #f57c00;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .card button:hover {
            background-color: #e65100;
        }
    </style>
</head>
<body>
    <div class="card">
        <p><?php echo htmlspecialchars($message); ?></p>
        <button onclick="window.location.href='login.php'">Voltar para Login</button>
    </div>
</body>
</html>
