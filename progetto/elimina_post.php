<?php
// Includi il file di connessione al database
include 'connection.php';

// Verifica se è stato inviato un ID del post
if (isset($_POST['id_post'])) {
    $id_post = intval($_POST['id_post']);

    // Query per eliminare il post
    $query = "DELETE FROM post WHERE id_post = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_post);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Errore durante l'eliminazione del post: " . $stmt->error;
    }
} else {
    echo "ID del post non specificato.";
}