<?php
include 'connection.php';
include 'header.php';

// Verifica se l'ID del blog è specificato nella query string
if (isset($_GET['id_blog'])) {
    $id_blog = intval($_GET['id_blog']);

    // Query per ottenere i dettagli del blog
    $query_blog = "SELECT * FROM blog WHERE cod_blog = $id_blog";
    $result_blog = $conn->query($query_blog);

    // Verifica se il blog esiste
    if ($result_blog->num_rows > 0) {
        $blog = $result_blog->fetch_assoc();

        // Verifica se l'utente è loggato
        if (isset($_SESSION['id_utente'])) {
            $id_utente = $_SESSION['id_utente'];

            // Query per verificare se l'utente è l'autore o un coautore del blog
            $query_autore = "SELECT * FROM coautori WHERE id_blog = ? AND id_utente = ?";
            $stmt = $conn->prepare($query_autore);
            $stmt->bind_param('ii', $id_blog, $id_utente);
            $stmt->execute();
            $result_autore = $stmt->get_result();

            // Verifica se l'utente è l'autore del blog
            $is_autore = ($blog['id_utente'] == $id_utente);

            // Verifica se l'utente è un coautore del blog
            $is_coautore = ($result_autore->num_rows > 0);
        } else {
            $is_autore = false;
            $is_coautore = false;
        }
    } else {
        echo "Blog non trovato.";
        exit;
    }

    // Query per ottenere i post del blog
    $query_post = "SELECT * FROM post WHERE cod_blog = $id_blog";
    $result_post = $conn->query($query_post);
} else {
    echo "ID del blog non specificato.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $blog['titolo']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1 class="mt-4"><?php echo $blog['titolo']; ?></h1>
        <p><?php echo $blog['descrizione']; ?></p>

        <?php
        // Mostra il pulsante per modificare il blog se l'utente è autore o coautore
        if ($is_autore || $is_coautore) {
            echo '<a href="modifica_blog.php?id_blog=' . $blog['cod_blog'] . '" class="btn btn-primary mb-4">Modifica Blog</a>';
            echo '<a href="nuovo_post.php?cod_blog=' . $blog['cod_blog'] . '" class="btn btn-success mb-4">Crea Nuovo Post</a>';
            echo '<a href="elimina_blog.php?id_blog=' . $blog['cod_blog'] . '" class="btn btn-danger mb-4" onclick="return confirm(\'Sei sicuro di voler eliminare questo blog?\')">Elimina Blog</a>';
        }
        ?>

        <h2 class="mt-4">Post</h2>
        <ul class="list-group mt-4">
            <?php
            // Verifica se ci sono post
            if ($result_post->num_rows > 0) {
                // Itera attraverso i risultati della query
                while ($post = $result_post->fetch_assoc()) {
                    echo '<li class="list-group-item mb-2">';
                    echo '<a href="post.php?id_post=' . $post['id_post'] . '">';
                    echo '<h5>' . $post['titolo_post'] . '</h5>';
                    echo '</a>';
                    echo '<p>' . $post['testo'] . '</p>';
                    echo '</li>';
                }
            } else {
                echo '<li class="list-group-item">Nessun post disponibile al momento.</li>';
            }
            ?>
        </ul>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>