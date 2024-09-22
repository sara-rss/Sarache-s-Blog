<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_comm = intval($_POST['id_comm']);
    $id_utente = $_SESSION['id_utente'];

    $query = "DELETE FROM commento WHERE id_comm = $id_comm AND id_utente = $id_utente";

    if ($conn->query($query) === TRUE) {
        echo "Commento eliminato con successo.";
    } else {
        echo "Errore durante l'eliminazione del commento: " . $conn->error;
    }
}
