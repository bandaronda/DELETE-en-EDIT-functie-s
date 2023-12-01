<?php
include 'db.php';

$database = new Database();

// Voeg een gebruiker toe als het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $database->voegGebruikerToe("Voornaam", "Achternaam", 25);
        echo "Nieuwe gebruiker toegevoegd.";

        // Stuur de gebruiker terug naar home.php om een nieuwe POST-request te voorkomen bij het vernieuwen van de pagina
        header("Location: home.php");
        exit();
    }
}

// Haal alle gebruikers op
$gebruikers = $database->haalGebruikersOp();

// Toon de gebruikers in een tabel
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Achternaam</th>
            <th>Leeftijd</th>
            <th>Bewerken</th>
            <th>Verwijderen</th>
        </tr>";

foreach ($gebruikers as $gebruiker) {
    echo "<tr>
            <td>{$gebruiker['id']}</td>
            <td>{$gebruiker['naam']}</td>
            <td>{$gebruiker['achternaam']}</td>
            <td>{$gebruiker['leeftijd']}</td>
            <td><a href='update.php?id={$gebruiker['id']}'>Edit</a></td>
            <td><a href='delete.php?id={$gebruiker['id']}'>Delete</a></td>
          </tr>";
}

echo "</table>";

$database->sluitVerbinding();
?>

<!-- HTML-formulier om handmatig een nieuwe gebruiker toe te voegen -->
<form method='post' action='home.php'>
    <input type='submit' name='submit' value='Voeg nieuwe gebruiker toe'>
</form>
