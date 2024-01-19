<?php
//creating variables
$pass = "qwerty";
$user = "germoskos";
$dbHand = null;
$dbHandler = null;

//creating connection to PHPMyAdmin
try{
    $dbHand = new PDO("mysql:host=mysql;charset=utf8", $user, $pass);//QUESTION: I haven't made the db yet, what should I do here?
} catch(Exception $ex){
    echo $ex;
}

//Creating database
if($dbHand){
    try{
        $stmt = $dbHand->prepare("
            CREATE DATABASE IF NOT EXISTS Germoskos;
        ");
        $stmt->execute();
    } catch(Exception $ex){
        echo $ex;
    }
}
$dbHand = null;

//creating connection to DB
try{
    $dbHandler = new PDO("mysql:host=mysql;dbname=Germoskos;charset=utf8", $user, $pass);
} catch(Exception $ex){
    echo $ex;
}

//Creating tables
if($dbHandler){
    try{
        $stmt = $dbHandler->prepare("
            CREATE TABLE IF NOT EXISTS Login (
                Login_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                Username VARCHAR(255) NOT NULL,
                Password VARCHAR(255) NOT NULL
            );
            CREATE TABLE IF NOT EXISTS Employees (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                Login_id INT NOT NULL,
                FOREIGN KEY (Login_id) REFERENCES Login(Login_id),
                Full_Name VARCHAR(255) NOT NULL,
                Role ENUM('Journalist', 'Editor', 'Photographer', 'Editor In Chief', 'Web Content Creator')
            );
            CREATE TABLE IF NOT EXISTS Tips (
                Tip_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                Status ENUM('NEW', 'Assigned', 'Rejected', 'Approved'),
                Date_Reported DATE DEFAULT CURRENT_DATE,
                Deadline DATE,
                Category ENUM('Crime', 'Politics', 'Business', 'Health', 'Environment', 'Weather', 'Sports'),
                Assigned_Editor INT NOT NULL,
                Assigned_Journalist INT NOT NULL,
                Assigned_Photographer INT NOT NULL,
                FOREIGN KEY (Assigned_Editor) REFERENCES Employees(id),
                FOREIGN KEY (Assigned_Journalist) REFERENCES Employees(id),
                FOREIGN KEY (Assigned_Photographer) REFERENCES Employees(id),
                Comments VARCHAR(255) NULL
            );
            CREATE TABLE IF NOT EXISTS Messages (
                Message_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                Message VARCHAR(255) NOT NULL,
                Sender_id INT NOT NULL,
                Reciever_id INT NOT NULL,
                FOREIGN KEY (Sender_id) REFERENCES Employees(id),
                FOREIGN KEY (Reciever_id) REFERENCES Employees(id)
            );
            CREATE TABLE IF NOT EXISTS Files (
                file_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                date_Uploaded DATE,
                File_Name VARCHAR(255),
                Uploaded_By ENUM('Mason Clark', 'Ava Rodriguez', 'Jackson Wright', 'Isabella Turner'),
                Last_Edited_By ENUM('Ethan Davis', 'Sophia Martinez', 'Jules Daalder', 'Mason Clark', 'Ava Rodriguez', 'Jackson Wright', 'Isabella Turner')
            );
            CREATE TABLE IF NOT EXISTS Pictures (
                picture_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                date_Uploaded DATE,
                File_Name VARCHAR(255),
                Uploaded_By ENUM('Liam Murphy', 'Harper Taylor', 'Noah Anderson', 'Olivia Johnson'),
                Last_Edited_By ENUM('Ethan Davis', 'Sophia Martinez', 'Jules Daalder', 'Liam Murphy', 'Harper Taylor', 'Noah Anderson', 'Olivia Johnson')
            );
        ");
        $stmt->execute();
    } catch(Exception $ex){
        echo $ex;
    }
}

$dbHandler = null;
?>