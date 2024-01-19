<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview</title>
</head>
<body>
    <h3>Overview over bugs in the database:</h3>
    <?php 
          // Database connectie parameters
          $host = "mysql";
          $dbname = "Bugreporter";
          $user = "root";
          $pass = "qwerty";
  
          // Probeer de connectie te maken
          try {
              $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  
              // Stel de PDO in om fouten te rapporteren.
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
              // Haal de bugrapporten op
              $stmt = $pdo->query("SELECT * FROM bugrapporten");
  
              if ($stmt) {
                  // Toon de bugrapporten zonder tabel
                  echo "<h2>Bugreport</h2>";
                  echo "<ul>";
  
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo "<br><li>";
                      echo "Productnaam: " . $row["productnaam"] . "<br>";
                      echo "Versie: " . $row["productversie"] . "<br>";
                      echo "Besturingssysteem: " . $row["besturingssysteem"] . "<br>";
                      echo "Frequentie: " . $row["frequentie"] . "<br>";
                      echo "Oplossing: " . $row["oplossing"] . "<br>";
                      echo "Edit bug: <a href='editBug.php?id=" . $row["id"] . "'>Edit</a>";
                      echo "</li>";
                  }
  
                  echo "</ul>";
              } else {
                  echo "No bug reports found.";
              }
          } catch (PDOException $e) {
              die("Error: " . $e->getMessage());
          }
      ?>
    <a href="./addBug.php">Add a bug</a>
</body>
</html>