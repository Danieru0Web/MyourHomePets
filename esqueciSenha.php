<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a senha</title>
    <style>
        /* Estilo geral para a página */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #fdfcdc;
            font-family: Arial, sans-serif;
        }

        /* Card centralizado */
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            padding: 20px;
            text-align: center;
        }

        /* Estilo do título */
        .card h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Estilo do formulário */
        .card form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Estilo do label */
        .card label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #666;
            text-align: left;
            width: 100%;
        }

        /* Estilo do campo de entrada */
        .card input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Estilo do botão */
        .card button {
            width: 100%;
            padding: 10px;
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
        <h1>Esqueci a senha</h1>
        <form method="post" action="sendPassword.php">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required> 
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>
