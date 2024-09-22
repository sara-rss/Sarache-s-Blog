<?php
include 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id_utente'])) {
    $id_post = intval($_POST['id_post']);
    $titolo_post = $conn->real_escape_string($_POST['titolo_post']);
    $testo = $conn->real_escape_string($_POST['testo']);
    $id_utente = $_SESSION['id_utente'];

    // Verifica se l'utente è l'autore del post o un coautore del blog
    $query = "SELECT post.*, blog.cod_blog AS cod_blog 
              FROM post 
              INNER JOIN blog ON post.cod_blog = blog.cod_blog 
              WHERE post.id_post = $id_post";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
        $id_autore = $post['id_utente'];
        $cod_blog = $post['cod_blog'];

        $is_autore_or_coautore = ($id_utente == $id_autore);

        // Query per verificare se l'utente è un coautore del blog
        $query_coautore = "SELECT * FROM coautori WHERE id_blog = ? AND id_utente = ?";
        $stmt = $conn->prepare($query_coautore);
        $stmt->bind_param('ii', $cod_blog, $id_utente);
        $stmt->execute();
        $result_coautore = $stmt->get_result();
        if ($result_coautore->num_rows > 0) {
            $is_autore_or_coautore = true;
        }

        if ($is_autore_or_coautore) {
            // Aggiorna il post
            $update_query = "UPDATE post SET titolo_post = ?, testo = ? WHERE id_post = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param('ssi', $titolo_post, $testo, $id_post);
            if ($stmt->execute()) {
                header("Location: post.php?id_post=$id_post");
            } else {
                echo "Errore durante l'aggiornamento del post.";
            }
        } else {
            echo "Non hai i permessi per modificare questo post.";
        }
    } else {
        echo "Post non trovato.";
    }
} else {
    echo "Richiesta non valida.";
}
