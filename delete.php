<?php
include 'db.php';

$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Voer hier de verwijderGebruiker-functie uit
    $database->verwijderGebruiker($id);

    echo "Gebruiker met ID $id is verwijderd";
    
    // Stuur de gebruiker terug naar home.php
    header("Location: home.php");
    exit();
}

// HTML-formulier om gebruikerinvoer te ontvangen en te verwijderen
$gebruikers = $database->haalGebruikersOp();

echo "<form method='post' action='delete.php'>";
echo "<select name='id'>";

foreach ($gebruikers as $gebruiker) {
    echo "<option value='{$gebruiker['id']}'>{$gebruiker['naam']} {$gebruiker['achternaam']}</option>";
}

echo "</select>";
echo "<button type='submit'>Delete</button>";
echo "</form>";

$database->sluitVerbinding();
?>
