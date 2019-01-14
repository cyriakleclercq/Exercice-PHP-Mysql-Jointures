<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 10/01/2019
 * Time: 10:12
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdd_classe";
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {

    die("Connection failed: ". $conn->connect_error);

} else {

    // Selectionner la base à utiliser

    $conn->select_db($dbname);
}