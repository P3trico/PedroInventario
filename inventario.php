<?php

$itens = file('inventario.txt', FILE_IGNORE_NEW_LINES);
$inventario = [];

foreach ($itens as $item) {
   
    $dados = explode(";", $item);
   
    if (count($dados) === 3) {
        $nome = $dados[0];
        $quantidade = $dados[1];
        $imagem = $dados[2];

        $inventario[] = [
            'nome' => $nome,
            'quantidade' => $quantidade,
            'imagem' => $imagem
        ];
    } else {
        
        continue;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventário - Jogo Estilo Undertale</title>

    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #000000;
            color: #ffffff;
            font-family: 'Press Start 2P', cursive;
            padding: 20px;
        }

        h1, h2 {
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

        .list-group-item {
            background-color: #222222;
            border: 1px solid #444444;
            color: #ffffff;
            font-size: 18px;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .list-group-item:hover {
            background-color: #444444;
            cursor: pointer;
        }

        .item-imagem {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            border-radius: 5px;
            border: 2px solid #00FF00;
        }

        .footer {
            text-align: center;
            color: #ffffff;
            font-size: 12px;
            margin-top: 20px;
        }

        .modal-content {
            background-color: #222222;
            color: #ffffff;
        }

        .modal-body img {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            display: block;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Inventário do Jogo</h1>

      
        <h2>Itens do Inventário</h2>
        <ul class="list-group">
            <?php foreach ($inventario as $item): ?>
                <li class="list-group-item" data-bs-toggle="modal" data-bs-target="#modalImagem<?= htmlspecialchars($item['nome']) ?>">
                    <?php if (filter_var($item['imagem'], FILTER_VALIDATE_URL)): ?>
                        <img src="<?= $item['imagem'] ?>" alt="<?= $item['nome'] ?>" class="item-imagem">
                    <?php else: ?>
                        <img src="imagens/<?= $item['imagem'] ?>" alt="<?= $item['nome'] ?>" class="item-imagem">
                    <?php endif; ?>
                    <?= htmlspecialchars($item['nome']) ?> - Quantidade: <?= $item['quantidade'] ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <br>
        
        <a href="adicionar_item.php" class="btn btn-primary">Adicionar Item</a>
    </div>

   
    <?php foreach ($inventario as $item): ?>
        <div class="modal fade" id="modalImagem<?= htmlspecialchars($item['nome']) ?>" tabindex="-1" aria-labelledby="modalLabel<?= htmlspecialchars($item['nome']) ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?= htmlspecialchars($item['nome']) ?>"><?= htmlspecialchars($item['nome']) ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php if (filter_var($item['imagem'], FILTER_VALIDATE_URL)): ?>
                            <img src="<?= $item['imagem'] ?>" alt="<?= $item['nome'] ?>">
                        <?php else: ?>
                            <img src="imagens/<?= $item['imagem'] ?>" alt="<?= $item['nome'] ?>">
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
