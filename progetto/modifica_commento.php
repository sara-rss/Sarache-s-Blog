<?php
include 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id_utente'])) {
    $id_comm = intval($_POST['id_comm']);
    $commento = $conn->real_escape_string($_POST['commento']);
    $id_utente = $_SESSION['id_utente'];

    // Verifica se l'utente è l'autore del commento
    $query = "SELECT * FROM commento WHERE id_comm = $id_comm AND id_utente = $id_utente";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        // Aggiorna il commento
        $update_query = "UPDATE commento SET text = ? WHERE id_comm = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('si', $commento, $id_comm);
        if ($stmt->execute()) {
            echo "Commento aggiornato con successo.";
        } else {
            echo "Errore durante l'aggiornamento del commento.";
        }
    } else {
        echo "Non hai i permessi per modificare questo commento.";
    }
} else {
    echo "Richiesta non valida.";
}
