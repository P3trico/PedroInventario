<?php
function itemExistente($nome, &$itens) {
    foreach ($itens as &$item) {
        if ($item['nome'] === $nome) {
            $item['quantidade']++;
            return true;
        }
    }
    return false;
}


$itens = file('inventario.txt', FILE_IGNORE_NEW_LINES);
$inventario = [];

foreach ($itens as $item) {
    $dados = explode(";", $item);
    $inventario[] = [
        'nome' => $dados[0],
        'quantidade' => $dados[1],
        'imagem' => $dados[2]
    ];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $imagem = $_FILES['imagem']['name'];
    $imagemUrl = $_POST['imagem_url'];  

   
    if (!empty($imagemUrl)) {
        $imagemFinal = $imagemUrl;
    } else {
       
        if (getimagesize($_FILES['imagem']['tmp_name']) !== false) {
            
            $target_dir = "imagens/";
            $target_file = $target_dir . basename($imagem);
            move_uploaded_file($_FILES['imagem']['tmp_name'], $target_file);
            $imagemFinal = $imagem;  
        } else {
            echo "O arquivo não é uma imagem válida.";
            exit();
        }
    }

    if (!itemExistente($nome, $inventario)) {
      
        $inventario[] = [
            'nome' => $nome,
            'quantidade' => $quantidade,
            'imagem' => $imagemFinal
        ];
    }

   
    file_put_contents('inventario.txt', '');
    foreach ($inventario as $item) {
        $linha = $item['nome'] . ";" . $item['quantidade'] . ";" . $item['imagem'] . PHP_EOL;
        file_put_contents('inventario.txt', $linha, FILE_APPEND);
    }

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Item - Jogo Estilo Undertale</title>

  
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #000000;
            color: #ffffff; 
            font-family: 'Press Start 2P', cursive;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #00FF00; 
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 5px solid #00FF00;
            border-radius: 10px;
            background-color: #222222;
        }

        .form-control {
            background-color: #333333;
            color: #ffffff;
            border: 2px solid #00FF00;
        }

        .form-control:focus {
            border-color: #FF00FF;
            background-color: #222222;
            color: #FF00FF;
        }

        .btn {
            background-color: #00FF00;
            color: #222222;
            border: 2px solid #00FF00;
        }

        .btn:hover {
            background-color: #FF00FF;
            border-color: #FF00FF;
            color: #222222;
        }

        .footer {
            text-align: center;
            color: #ffffff;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Adicionar Novo Item</h1>

       
        <form action="adicionar_item.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Item</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" value="1" min="1" required>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem do Item (Arquivo)</label>
                <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="imagem_url" class="form-label">Ou URL da Imagem</label>
                <input type="url" class="form-control" id="imagem_url" name="imagem_url" placeholder="Ex: https://example.com/imagem.png">
            </div>

            <button type="submit" class="btn btn-primary">Adicionar Item</button>
        </form>

        <br>

        <a href="index.php" class="btn btn-secondary">Voltar ao Inventário</a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
