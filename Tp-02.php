<?php
$acteurs = [
    0 => ['prenom' => 'Brad', 'nom' => 'PITT'],
    1 => ['prenom' => 'Tom', 'nom' => 'CRUISE']
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des Acteurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            display: flex;
            gap: 20px;
            width: 80%;



        }
        .left-column, .right-column {
            background-color: #ccffcc;
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
            
        }

        .right-column {
            gap: 10px;
            justify-content: center;

        }
        .left-column-item, .detail-item {
            background-color: #fff;
            padding: 10px;
            text-align: center;
            flex: 1;

        }
        .detail-grid {
            display: grid;
            grid-template-columns: auto auto;
            gap: 10px;
            width: 100%;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="left-column">
            <?php foreach ($acteurs as $index => $element): ?>
                <div class='left-column-item'><?= $index ?></div>
            <?php endforeach; ?>
        </div>
        <div class="right-column">
            <?php foreach ($acteurs as $element): ?>
                <div class='detail-grid'>
                    <div class='detail-item'>prenom</div>
                    <div class='detail-item'><?= $element['prenom'] ?></div>
                    <div class='detail-item'>nom</div>
                    <div class='detail-item'><?= $element['nom'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
