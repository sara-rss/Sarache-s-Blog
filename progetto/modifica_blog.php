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

            // Verifica se l'utente è autorizzato (autore o coautore)
            if (!$is_autore && !$is_coautore) {
                echo "Non sei autorizzato a modificare questo blog.";
                exit;
            }
        } else {
            echo "Non sei autorizzato a modificare questo blog. Devi essere loggato.";
            exit;
        }
    } else {
        echo "Blog non trovato.";
        exit;
    }
} else {
    echo "ID del blog non specificato.";
    exit;
}

// Gestione della modifica del blog
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prendi i dati dal form
    $nuovo_titolo = $_POST['titolo'];
    $nuova_descrizione = $_POST['descrizione'];

    // Query per aggiornare il blog nel database
    $query_update_blog = "UPDATE blog SET titolo = ?, descrizione = ? WHERE cod_blog = ?";
    $stmt_update_blog = $conn->prepare($query_update_blog);
    $stmt_update_blog->bind_param('ssi', $nuovo_titolo, $nuova_descrizione, $id_blog);

    if ($stmt_update_blog->execute()) {
        echo "Blog aggiornato con successo.";
        // Redirect alla pagina del blog aggiornato
        header("Location: view_blog.php?id_blog=$id_blog");
        exit;
    } else {
        echo "Errore durante l'aggiornamento del blog: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1 class="mt-4">Modifica Blog</h1>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id_blog=' . $id_blog; ?>">
            <div class="form-group">
                <label for="titolo">Titolo</label>
                <input type="text" class="form-control" id="titolo" name="titolo" value="<?php echo $blog['titolo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="descrizione">Descrizione</label>
                <textarea class="form-control" id="descrizione" name="descrizione" rows="3" required><?php echo $blog['descrizione']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
        </form>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>