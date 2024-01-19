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
                WHERE Status='NEW';
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
        <section class="top">
            <h1>Welcome, $role!</h1>
            <div class="topMsg">
                <div>
                    <h4>New Messages</h4>
                    <p>One new message from $sender: $message</p>
                </div>
                <div>
                    <h4>Latest Updates</h4>
                    <p>Updates</p>
                </div>
            </div>
        </section>
        <hr/>
        <section class="middle">
            <div>
                <h2>Unassigned Tips</h2>
                <table class="tipDash">
                    <tr class="dashHeader">
                        <th>ID</th>
                        <th>Status</th>
                        <th>Date Reported</th>
                        <th>Category</th>
                    </tr>
                    <tr>
                    <?php
                        for($i=0; $i<count($results); $i++){
                            if($results[$i]['Status'] == "NEW"){
                                $id = $results[$i]['Tip_id'];
                                echo "<td><a href='edit.php?Tip_id=$id'>".$id."</a></td>";
                                echo "<td>".$results[$i]['Status']."</td>";
                                echo "<td>".$results[$i]['Date_Reported']."</td>";
                                echo "<td>".$results[$i]['Category']."</td>";
                            }
                        };
                    ?>
                    </tr>
                </table>
                <button><a href="dashboard.php">More</a></button>
            </div>
            <div>
                <h2>Appointments</h2>
                <table>
                    <tr>
                        <td>Meeting with Jules in 4 days</td>
                    </tr>
                    <tr>
                        <td>Meeting with Esther in 1 week</td>
                    </tr>
                    <tr>
                        <td><button>Plan a new appointment</button></td>
                    </tr>
                </table>
            </div>
        </section>
        <section class="bottom">
            <h2>Latest Updates</h2>
            <div>
                <div>
                    <h3>New</h3>
                    <p>Lorem ipsum</p>
                </div>
                <div>
                    <h3>Yesterday</h3>
                    <p>Lorem ipsum</p>
                </div>
            </div>
        </section>
        <footer>Germoskos&copy; 2023</footer>
    </main>
</body>
</html>