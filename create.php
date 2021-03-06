<?php

session_start();
$username = $_SESSION['username'];
$isAdmin = $_SESSION['isAdmin'];
$userID = $_SESSION['userID'];

if($username == ""){
    header("Location: ../loginPage.php");
}

function valid($str) {
    return preg_match('/^[A-Za-z0-9_~\-!@#\$%\^&*\(\)]+$/',$str);

}

$eateryID = $_POST['eatery'];
$title = $_POST['title'];
$title = preg_replace('#<(.*?)>(.*?)</(.*?)>#is', '', $title);
$review = $_POST['review'];
$review = preg_replace('#<(.*?)>(.*?)</(.*?)>#is', '', $review);
$rating = $_POST['rating'];
$date = date("y.m.d h:i:S a");

$conn = new mysqli("localhost", "group6", "fall2017188953", "group6");

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$query = $conn->prepare("INSERT INTO Post (title, review, rating, userID, eateryID, time) Values (?, ?, ?, ?, ?, ?)");

$query->bind_param("sssiis", $title, $review, $rating, $userID, $eateryID, $date);

if($query->execute() === TRUE){
    echo "New record created successfully";
}else{
    echo "Error: " . $query . "<br>" . $conn->error;
}
$query->close();
$conn->close();

switch($eateryID){
    case 1:
        header("Location: ../locations/cafeteria.php");
        break;
    case 2:
        header("Location: ../locations/ChickFilA.php");
        break;
    case 3:
        header("Location: ../locations/starbucks.php");
        break;
    case 4:
        header("Location: ../locations/papajohns.php");
        break;
    case 5:
        header("Location: ../locations/einsteinbagles.php");
        break;
    case 6:
        header("Location: ../locations/pitapit.php");
        break;
}