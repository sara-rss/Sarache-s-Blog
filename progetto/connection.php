<?php

// Parametri per la connessione al database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "SaraRossi_RacheleGalletti";

// Tentativo di connessione al database
$conn = new mysqli($servername, $username, $password, $database);

// Controllo della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Impostazione del set di caratteri
$conn->set_charset("utf8mb4");
