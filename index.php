<?php
$host = "localhost";
$db = "tp_1";
$user = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

// Utilisez try-catch pour gérer les exceptions PDO
try {
    $oPDO = new PDO($dsn, $user, $password);
    // Configurez PDO pour générer des exceptions en cas d'erreur SQL
    $oPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the $db database successfully";
} catch (PDOException $e) {
    // En cas d'erreur de connexion, affichez l'erreur
    die("Connection failed: " . $e->getMessage());
}

require_once "class/CRUD.php";
require_once "class/Lampe.php";

$crud = new CRUD($oPDO);
$lampe = new Lampe($crud);
$result = "";

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    if ($_POST["action"] == "getLampes") {
        $lampes = $crud->getLampes();
    } elseif ($_POST["action"] == "getLampeById" && isset($_POST["id"])) {
        $id = $_POST["id"];
        // Appelez la méthode getLampeById() à partir de l'instance CRUD
        $result = $crud->getLampeById($id);
    } elseif ($_POST["action"] == "addLampe" && isset($_POST["brand"], $_POST["type"], $_POST["model"], $_POST["price"])) {
        $newLampe = [
            "brand" => $_POST["brand"],
            "type" => $_POST["type"],
            "model" => $_POST["model"],
            "price" => $_POST["price"]
        ];
        $insertedId = $crud->addLampe($newLampe);
        if ($insertedId) {
            $result = "Lampe ajoutée avec l'ID : $insertedId";
        } else {
            $result = "Échec de l'ajout de la lampe";
        }
    } elseif ($_POST["action"] == "updateLampeById" && isset($_POST["id"], $_POST["brand"], $_POST["type"], $_POST["model"], $_POST["price"])) {
        $id = $_POST["id"];
        $updatedLampe = [
            "brand" => $_POST["brand"],
            "type" => $_POST["type"],
            "model" => $_POST["model"],
            "price" => $_POST["price"]
        ];
        $success = $crud->updateLampeById($id, $updatedLampe);
        if ($success) {
            $result = "Lampe mise à jour avec succès";
        } else {
            $result = "Échec de la mise à jour de la lampe";
        }
    } elseif ($_POST["action"] == "deleteLampeById" && isset($_POST["id"])) {
        $id = $_POST["id"];
        $result = $crud->deleteLampeById($id);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire Lampe</title>
</head>
<style>
h1,h2,div,ul,.centered{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}


</style>

<body>
    <h1>Gestion des Lampes</h1>

    <!-- Affichage des résultats -->
    <?php if (!empty($result)) : ?>
        <div>
            <?php if (is_array($result)) : ?>
                <ul>
                    <?php foreach ($result as $item) : ?>
                        <li><?php echo $item; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <?php echo $result; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Afficher la liste de toutes les lampes -->
    <?php if (isset($lampes) && is_array($lampes)) : ?>
        <h2>Liste de toutes les lampes :</h2>
        <ul>
            <?php foreach ($lampes as $lampe) : ?>
                <li>
                    <?php echo "ID: " . $lampe['id'] . ", Marque: " . $lampe['brand'] . ", Type: " . $lampe['type'] . ", Modèle: " . $lampe['model'] . ", Prix: " . $lampe['price']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- Formulaire pour interagir avec les fonctions de la classe Lampe -->
    <form method="post" class="centered">
        <label for="action">Action :</label>
        <select name="action" id="action">
            <option value="getLampes">Lister toutes les lampes</option>
            <option value="getLampeById">Obtenir une lampe par ID</option>
            <option value="addLampe">Ajouter une lampe</option>
            <option value="updateLampeById">Mettre à jour une lampe par ID</option>
            <option value="deleteLampeById">Supprimer une lampe par ID</option>
        </select>
        <br>

        <label for="id">ID de la lampe (si nécessaire) :</label>
        <input type="number" name="id" id="id">
        <br>

        <label for="brand">Marque :</label>
        <input type="text" name="brand" id="brand">
        <br>

        <label for="type">Type :</label>
        <input type="text" name="type" id="type">
        <br>

        <label for="model">Modèle :</label>
        <input type="text" name="model" id="model">
        <br>

        <label for="price">Prix :</label>
        <input type="text" name="price" id="price">
        <br>

        <input type="submit" value="Soumettre">
    </form>
</body>
</html>