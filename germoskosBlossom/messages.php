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
    <section>
        <h1>Messages</h1>
        <?php
            foreach($users as $user){
                echo "
                <img alt='user' src=''>
                <p>$user</p>
                <hr>
                ";
            }
        ?>
    </section>
    <section>
        <h1><?=$user?></h1>
        <?php
        if($recieved == true){
            foreach($Rmessages as $Rmessage){
                echo "
                <div class='recieved'>
                    <p>$Rmessage</p>
                </div>
                ";
            }
        }
        if($sent == true){
            foreach($Smessages as $Smessage){
                echo "
                <div class='sent'>
                    <p>$message</p>
                </div>
                ";
            }
        }
        ?>
        <form>
            <input type="text" placeholder="Type Something">
        </form>
    </section>
    <footer>Germoskos 2023&copy;</footer>
</body>
</html>