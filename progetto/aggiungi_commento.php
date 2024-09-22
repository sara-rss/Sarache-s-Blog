<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commento = $conn->real_escape_string($_POST['commento']);
    $id_utente = $_SESSION['id_utente'];
    $id_post = intval($_POST['id_post']);

    // Query per inserire il commento nel database
    $query = "INSERT INTO commento (text, id_utente, id_post) VALUES ('$commento', '$id_utente', '$id_post')";

    if ($conn->query($query) === TRUE) {
        $id_comm = $conn->insert_id;

        // Query per ottenere i dettagli dell'utente (nome, cognome, premium)
        $utente_query = "SELECT nome, cognome, premium FROM utente WHERE id_utente = $id_utente";
        $utente_result = $conn->query($utente_query);
        $utente = $utente_result->fetch_assoc();

        // Costruisci il markup HTML per il commento
        echo '<div class="card mb-2 comment" data-id="' . $id_comm . '">';
        echo '<div class="card-body">';

        // Mostra il badge "premium" se l'utente è premium
        if ($utente['premium']) {
            echo '<span class="badge badge-warning">Premium</span>';
        }

        echo '<p class="card-text">' . $commento . '</p>';
        echo '<p class="card-text"><small class="text-muted">Commento di ' . $utente['nome'] . ' ' . $utente['cognome'] . '</small></p>';

        // Mostra pulsante di eliminazione solo se l'utente è l'autore del commento
        if ($id_utente == $_SESSION['id_utente']) {
            echo '<button class="btn btn-danger delete-comment-btn" data-id="' . $id_comm . '">Elimina</button>';
        }

        echo '</div>';
        echo '</div>';
    } else {
        echo "Errore durante l'aggiunta del commento: " . $conn->error;
    }
}
