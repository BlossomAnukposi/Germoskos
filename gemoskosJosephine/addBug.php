<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $dbname = "Bugreporter";
    $user = "germoskos";
    $password = "qwerty";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $productnaam = $_POST['productnaam'];
        $productversie = $_POST['productversie'];
        $hardware = $_POST['hardware'];
        $besturingssysteem = $_POST['besturingssysteem'];
        $frequentie = $_POST['frequentie'];
        $oplossing = $_POST['oplossing'];
        
        $stmt = $pdo->prepare("INSERT INTO bugrapporten (productnaam, productversie, hardware, besturingssysteem, frequentie, oplossing) 
        VALUES (:productnaam, :productversie, :hardware, :besturingssysteem, :frequentie, :oplossing)");

        $stmt->bindParam(':productnaam', $productnaam);
        $stmt->bindParam(':productversie', $productversie);
        $stmt->bindParam(':hardware', $hardware);
        $stmt->bindParam(':besturingssysteem', $besturingssysteem);
        $stmt->bindParam(':frequentie', $frequentie);
        $stmt->bindParam(':oplossing', $oplossing);

        $stmt->execute();


    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add bug</title>
</head>
<body>
<form action="" method="post">
	    <h2>Add a bug here:</h2>
        <label for="productnaam">Producname:</label>
        <input type="text" name="productnaam" required><br>

        <label for="productversie">Product version:</label>
        <input type="text" name="productversie" required><br>

        <label for="hardware">Hardware type:</label>
        <input type="text" name="hardware" required><br>

        <label for="besturingssysteem">System</label>
        <input type="text" name="besturingssysteem" required><br>

        <label for="frequentie">Frequency</label>
        <input type="text" name="frequentie" required><br>

        <label for="oplossing">Solution</label>
        <textarea name="oplossing" rows="4" required></textarea><br>

        <input type="submit" value="Submit">
    </form>
    <a href="./index.php">Go back</a>
</body>
</html>