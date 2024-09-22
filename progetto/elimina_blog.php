<?php
include 'connection.php';
include 'header.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id_blog'])) {
    $id_blog = intval($_GET['id_blog']);

    // Verifica se l'utente è autore del blog
    $id_utente = $_SESSION['id_utente'];
    $query_blog = "SELECT * FROM blog WHERE cod_blog = $id_blog AND id_utente = $id_utente";
    $result_blog = $conn->query($query_blog);

    if ($result_blog->num_rows > 0) {
        // Elimina tutti i post associati al blog
        $query_elimina_post = "DELETE FROM post WHERE cod_blog = $id_blog";
        if ($conn->query($query_elimina_post) === TRUE) {
            // Elimina il blog
            $query_elimina_blog = "DELETE FROM blog WHERE cod_blog = $id_blog";
            if ($conn->query($query_elimina_blog) === TRUE) {
                header("Location: index.php");
                exit;
            } else {
                echo "Errore nell'eliminazione del blog: " . $conn->error;
            }
        } else {
            echo "Errore nell'eliminazione dei post: " . $conn->error;
        }
    } else {
        echo "Blog non trovato o non hai i permessi per eliminarlo.";
    }
} else {
    echo "ID del blog non specificato.";
}
