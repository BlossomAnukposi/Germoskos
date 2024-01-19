<?php
    require_once "dbStmt.php";

    //creating connection to DB
    try{
        $dbHandler = new PDO("mysql:host=mysql;dbname=Germoskos;charset=utf8", $user, $pass);//QUESTION: I haven't made the db yet, what should I do here?
    } catch(Exception $ex){
        echo $ex;
    }

    if($dbHandler){
        try{
            $stmt = $dbHandler->prepare("
                SELECT *
                FROM Tips
            ");
            $stmt->execute();
        } catch(Exception $ex){
            echo $ex;
        }
        $results = $stmt->fetchall(PDO::FETCH_ASSOC);
    }
?>

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
        <main>
            <h1 class="top">Tip Dashboard</h1>
            <table class="tipDash mainDash">
                <tr class="dashHeader">
                    <th>ID</th>
                    <th>Status</th>
                    <th>Date Reported</th>
                    <th>Deadline</th>
                    <th>Category</th>
                    <th>Assigned_Editor</th>
                    <th>Assigned_Journalist</th>
                    <th>Assigned_Photographer</th>
                    <th>Comments</th>
                </tr>
                <hr/>
                <tr>
                <?php
                    for($i=0; $i<count($results); $i++){
                        $id = $results[$i]['Tip_id'];
                        echo "<td><a href='edit.php?Tip_id=$id'>".$results[$i]['Tip_id']."</td>";
                        echo "<td>".$results[$i]['Status']."</td>";
                        echo "<td>".$results[$i]['Date_Reported']."</td>";
                        echo "<td>".$results[$i]['Deadline']."</td>";
                        echo "<td>".$results[$i]['Category']."</td>";
                        echo "<td>".$results[$i]['Assigned_Editor']."</td>";
                        echo "<td>".$results[$i]['Assigned_Journalist']."</td>";
                        echo "<td>".$results[$i]['Assigned_Photographer']."</td>";
                        echo "<td>".$results[$i]['Comments']."</td>";
                    };
                ?>
                </tr>
            </table>
        </main>
    </body>
</html>