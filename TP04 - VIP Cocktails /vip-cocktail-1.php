<?php
session_start();

// Initialiser la liste d'invités s'il n'existe pas
if (!isset($_SESSION['guestList'])) {
    $_SESSION['guestList'] = [];
}

// Fonction pour ajouter une personne à la liste
function addGuest($name, $surname) {
    $_SESSION['guestList'][] = ['name' => $name, 'surname' => $surname, 'status' => 'pending'];
}

// Fonction pour modifier le statut d'une personne
function updateGuestStatus($index, $newStatus) {
    if (isset($_SESSION['guestList'][$index])) {
        $_SESSION['guestList'][$index]['status'] = $newStatus;
    }
}

// Fonction pour enlever une personne de la liste
function removeGuest($index) {
    if (isset($_SESSION['guestList'][$index])) {
        unset($_SESSION['guestList'][$index]);
        $_SESSION['guestList'] = array_values($_SESSION['guestList']); // Réindexer le tableau
    }
}

// Gérer les requêtes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $name = htmlspecialchars($_POST['name']);
                $surname = htmlspecialchars($_POST['surname']);
                addGuest($name, $surname);
                break;
            case 'update':
                $index = intval($_POST['index']);
                $status = htmlspecialchars($_POST['status']);
                updateGuestStatus($index, $status);
                break;
            case 'remove':
                $index = intval($_POST['index']);
                removeGuest($index);
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Team Builder</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"/>
    <link rel=icon
          href=https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/svgs/solid/martini-glass-citrus.svg>
    <style>
        .bg-gris {
            background-color: #ccc;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fa-solid fa-martini-glass-citrus me-4"></i>
            VIP Cocktail
        </a>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="bg-gris p-4">
                <form method="POST">
                    <div class="row">
                        <div class="col-4">
                            <input name="surname" aria-label="Nom" class="form-control" placeholder="Nom" required/>
                        </div>
                        <div class="col-4">
                            <input name="name" aria-label="Prenom" class="form-control" placeholder="Prenom" required/>
                        </div>
                        <div class="col-1">
                            <input type="hidden" name="action" value="add"/>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <table class="table table-striped mt-4">
                <tbody>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th colspan="2">Actions</th>
                </tr>
                <?php foreach ($_SESSION['guestList'] as $index => $guest): ?>
                    <tr class="<?= $guest['status'] == 'confirmed' ? 'table-success' : 'table-danger' ?>">
                        <td><?= htmlspecialchars($guest['name']) ?></td>
                        <td><?= htmlspecialchars($guest['surname']) ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="update"/>
                                <input type="hidden" name="index" value="<?= $index ?>"/>
                                <input type="hidden" name="status" value="<?= $guest['status'] == 'confirmed' ? 'pending' : 'confirmed' ?>"/>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-check"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="remove"/>
                                <input type="hidden" name="index" value="<?= $index ?>"/>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- col8 -->
    </div>
    <!-- row -->
</div>
<footer class="py-5 bg-dark">
    <div class="container px-4 px-lg-5">
        <p class="m-0 text-center text-white">
            Copyright &copy; Seven Valley 2023
        </p>
    </div>
</footer>
</body>
</html>
