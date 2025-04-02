<?php
session_start();

define('USER_FILE', 'usuarios.txt');

function registrarUsuario($username, $password) {
    $usuarios = file(USER_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
    foreach ($usuarios as $usuario) {
        list($user) = explode(';', $usuario);
        if ($user === $username) {
            return "Usuário já existe!";
        }
    }
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    file_put_contents(USER_FILE, "$username;$hashedPassword\n", FILE_APPEND);
    return true;
}

function autenticarUsuario($username, $password) {
    $usuarios = file(USER_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
    foreach ($usuarios as $usuario) {
        list($user, $hashedPassword) = explode(';', $usuario);
        if ($user === $username && password_verify($password, $hashedPassword)) {
            $_SESSION['user'] = $username;
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $action = $_POST['action'];
    
    if ($action === 'register') {
        $result = registrarUsuario($username, $password);
        $message = $result === true ? "Conta criada com sucesso!" : $result;
    } elseif ($action === 'login') {
        if (autenticarUsuario($username, $password)) {
            header("Location: inventario.php");
            exit();
        } else {
            $message = "Usuário ou senha incorretos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: black; color: white; font-family: 'Press Start 2P', cursive; }
        .container { max-width: 400px; margin: auto; padding: 20px; background: #222; border: 3px solid #00FF00; border-radius: 10px; }
        .btn { background: #00FF00; color: #222; border: none; }
        .btn:hover { background: #FF00FF; }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1>Login</h1>
        <?php if (!empty($message)) echo "<p style='color:red;'>$message</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Usuário" required class="form-control mb-2">
            <input type="password" name="password" placeholder="Senha" required class="form-control mb-2">
            <button type="submit" name="action" value="login" class="btn w-100">Entrar</button>
        </form>
        <h2>Registrar</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Usuário" required class="form-control mb-2">
            <input type="password" name="password" placeholder="Senha" required class="form-control mb-2">
            <button type="submit" name="action" value="register" class="btn w-100">Criar Conta</button>
        </form>
    </div>
</body>
</html>