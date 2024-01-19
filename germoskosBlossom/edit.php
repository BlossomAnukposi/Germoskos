<?php
require_once "dbStmt.php";
$id = $_GET['Tip_id'];

//creating connection to DB
try{
    $dbHandler = new PDO("mysql:host=mysql;dbname=Germoskos;charset=utf8", $user, $pass);//QUESTION: I haven't made the db yet, what should I do here?
} catch(Exception $ex){
    echo $ex;
}

if($dbHandler){
    try{
        $stmt = $dbHandler->prepare("
            SELECT Tip_id, Status, Date_Reported, Deadline, Category, a1.Full_Name AS Assigned_Editor, a2.Full_Name AS Assigned_Journalist, a3.Full_Name AS Assigned_Photographer, Comments
            FROM Tips
            INNER JOIN Employees a1 ON Tips.Assigned_Editor = a1.id
            INNER JOIN Employees a2 ON Tips.Assigned_Journalist = a2.id
            INNER JOIN Employees a3 ON Tips.Assigned_Photographer = a3.id
            WHERE Tip_id=:id;
        ");
        $stmt->bindParam("id", $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch(Exception $ex){
        echo $ex;
    }
    $results = $stmt->fetchall(PDO::FETCH_ASSOC);
}

//Making all sorts of variables
$statusOp = ["NEW", "ASSIGNED", "REJECTED", "APPROVED"];
$status = $results[0]['Status'];
$reported = $results[0]['Date_Reported'];
$deadline = $results[0]['Deadline'];
$category = $results[0]['Category'];
$editor = $results[0]['Assigned_Editor'];
$journalist = $results[0]['Assigned_Journalist'];
$photographer = $results[0]['Assigned_Photographer'];
$comments = $results[0]['Comments'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Blossom" content="germoskos office">
    <title>Germoskos Office</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/keyboard-css@1.2.4/dist/css/main.min.css" />
</head>
<body>
    <nav><?php include "navbar.php"; ?></nav>
    <main>
        <h1 class="top">Tip #<?=$id?></h1>
        <hr/>
        <form method="post" action="dashboard.php">
            <section class="middle">   
                <div class="formId">
                    <p>ID<br>#<?=$id?></p>
                    <select name="status">
                        <?php
                        foreach($statusOp as $op){?>
                            <option value="<?=$op?>" <?php if($status == $op){ echo "selected"; } ?>><?=$op?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="info">
                    <table>
                        <tr>
                            <td><p>Date posted: <?=$reported?></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><p>Category: <?=$category?></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><?php if(isset($photographer)){echo "<p>Assigned Photographer: $photographer</p>";} ?></td>
                            <td>
                                <p>
                                    <select><?php foreach($statusOp as $op){?> 
                                        <option value="<?=$op?>"><?=$op?></option><?php }?>
                                    </select>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td><?php if(isset($journalist)){ echo "<p>Assigned Journalist: $journalist</p>"; } ?></td>
                            <td>
                                <p>
                                    <select><?php foreach($statusOp as $op){?>
                                        <option value="<?=$op?>"><?=$op?></option><?php } ?>
                                    </select>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td><?php if(isset($photographer)){ echo "<p>Assigned Editor: $editor</p>"; } ?></td>
                            <td>
                                <p>
                                    <select><?php foreach($statusOp as $op){?>
                                        <option value="<?=$op?>"><?=$op?></option><?php } ?>
                                    </select>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>
            <hr/>
            <section class="send">
                <div class="Btns">
                    <img src="images/firstDraft.png" class="dummyBtn">
                    <img src="images/secondDraft.png" class="dummyBtn">
                    <img src="images/allImages.png" class="dummyBtn">
                    <img src="images/approvedImages.png" class="dummyBtn">
                </div>
                <div>
                    <form method="post" action="dashboard.php">
                        <textarea placeholder="Leave a comment"></textarea>
                    </form>
                </div>
                <p><input type="submit" value="save" class="sendBtn"></p>
            </section>
        </form>
        <footer>Germoskos 2023&copy;</footer>
    </main>
</body>
</html>