<?php
// Databaseconfiguratie
$host = "mysql";
$dbname = "Bugreporter";
$user = "groupb";
$pass = "qwerty";

try {
    // Maak verbinding met de database via PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // Haal buggegevens op basis van bug-ID
    $bug_id = $_GET['id'];
    $sql = "SELECT * FROM bugrapporten WHERE id = :bug_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':bug_id', $bug_id, PDO::PARAM_INT);
    $stmt->execute();

    // Controleer of er resultaten zijn
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Haal gegevens op uit de database
        $productnaam = $row['productnaam'];
        $productversie = $row['productversie'];
        $hardware = $row['hardware'];
        $besturingssysteem = $row['besturingssysteem'];
        $frequentie = $row['frequentie'];
        $oplossing = $row['oplossing'];
    } else {
        echo "Bugrapport niet gevonden.";
        exit();
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Controleer op formulierindiening
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haal bijwerkingsgegevens op van het formulier
    $productnaam = $_POST['productnaam'];
    $productversie = $_POST['productversie'];
    $hardware = $_POST['hardware'];
    $besturingssysteem = $_POST['besturingssysteem'];
    $frequentie = $_POST['frequentie'];
    $oplossing = $_POST['oplossing'];

    // Voer hier de bijwerkingslogica uit
    try {
        $sqlUpdate = "UPDATE bugrapporten 
        SET productnaam = :productnaam, productversie = :productversie, hardware = :hardware, besturingssysteem = :besturingssysteem, frequentie = :frequentie, oplossing = :oplossing
        WHERE id = :bug_id";

        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':productnaam', $productnaam);
        $stmtUpdate->bindParam(':productversie', $productversie);
        $stmtUpdate->bindParam(':hardware', $hardware);
        $stmtUpdate->bindParam(':besturingssysteem', $besturingssysteem);
        $stmtUpdate->bindParam(':frequentie', $frequentie);
        $stmtUpdate->bindParam(':oplossing', $oplossing);
        $stmtUpdate->bindParam(':bug_id', $bug_id, PDO::PARAM_INT);

        $stmtUpdate->execute();

        // Doorsturen naar index.php
        header("Location: index.php");
        exit(); // Zorg ervoor dat het script stopt na het doorsturen
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        <header></header>
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Bewerk Bugrapport</title>
</head>
<body>
    <form action="" method="post">
	    <h2>Bewerk Bugrapport</h2>
        <label for="productnaam">Productnaam:</label>
        <input type="text" name="productnaam" value="<?php echo htmlspecialchars($productnaam); ?>" required>

        <label for="productversie">Productversie:</label>
        <input type="text" name="productversie" value="<?php echo htmlspecialchars($productversie); ?>" required>

        <label for="hardware">Type hardware:</label>
        <input type="text" name="hardware" value="<?php echo htmlspecialchars($hardware); ?>" required>

        <label for="besturingssysteem">Besturingssysteem:</label>
        <input type="text" name="besturingssysteem" value="<?php echo htmlspecialchars($besturingssysteem); ?>" required>

        <label for="frequentie">Frequentie van het optreden:</label>
        <input type="text" name="frequentie" value="<?php echo htmlspecialchars($frequentie); ?>" required>

        <label for="oplossing">Voorgestelde oplossingen:</label>
        <textarea name="oplossing" rows="4" required><?php echo htmlspecialchars($oplossing); ?></textarea>

        <input type="submit" value="Rapport indienen">
    </form>
</body>
</html>

<?php
// Sluit de databaseverbinding
$pdo = null;
?>
