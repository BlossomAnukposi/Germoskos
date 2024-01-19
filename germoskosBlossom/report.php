<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Blossom" content="germoskos office">
    <title>Germoskos Office</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav><?php include "navbar.php"; ?></nav>
    <h1>Germoskos Office</h1>
    <hr/>
    <form>
        <h2>Report an incident</h2>
        <p>What is this report about?<br>
            <input type="text" name="username">
        </p>
        <p>Short description of the incident<br>
            <textarea placeholder="Type Something"></textarea>
        </p>
        <input type="submit" value="Send">
    </form>
    <hr/>
    <footer>Germoskos 2023&copy;</footer>
</body>
</html>