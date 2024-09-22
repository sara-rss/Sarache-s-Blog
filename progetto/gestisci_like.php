<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_post = intval($_POST['id_post']);
    $id_utente = $_SESSION['id_utente'];

    // Controlla se l'utente ha già messo mi piace
    $check_query = "SELECT * FROM likes WHERE id_post = $id_post AND id_utente = $id_utente";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // Rimuovi il like
        $delete_query = "DELETE FROM likes WHERE id_post = $id_post AND id_utente = $id_utente";
        $conn->query($delete_query);
    } else {
        // Aggiungi il like
        $insert_query = "INSERT INTO likes (id_post, id_utente) VALUES ($id_post, $id_utente)";
        $conn->query($insert_query);
    }

    // Conta i like aggiornati
    $count_query = "SELECT COUNT(*) as like_count FROM likes WHERE id_post = $id_post";
    $count_result = $conn->query($count_query);
    $count = $count_result->fetch_assoc();

    echo $count['like_count'];
}
