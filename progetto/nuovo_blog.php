<?php
include 'connection.php';
include 'header.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Verifica se l'utente è premium
$id_utente = $_SESSION['id_utente'];
$query_utente = "SELECT premium FROM utente WHERE id_utente = $id_utente";
$result_utente = $conn->query($query_utente);
if ($result_utente->num_rows > 0) {
    $utente = $result_utente->fetch_assoc();
    $is_premium = $utente['premium'];
} else {
    // Gestione errore: utente non trovato
    echo "Errore: utente non trovato.";
    exit;
}

// Verifica se l'utente è non premium e ha già 2 blog
$showForm = true;
$errorMessage = '';

if (!$is_premium) {
    $query_blog_count = "SELECT COUNT(*) AS num_blogs FROM blog WHERE id_utente = $id_utente";
    $result_blog_count = $conn->query($query_blog_count);
    if ($result_blog_count->num_rows > 0) {
        $blog_count = $result_blog_count->fetch_assoc()['num_blogs'];
        if ($blog_count >= 2) {
            $showForm = false;
            $errorMessage = "Non puoi creare più di 2 blog se non sei un utente premium.";
        }
    }
}

// Gestione dell'invio del modulo
if ($_SERVER["REQUEST_METHOD"] == "POST" && $showForm) {
    $titolo = $conn->real_escape_string($_POST['titolo']);
    $descrizione = $conn->real_escape_string($_POST['descrizione']);
    $categ = intval($_POST['categ']);
    $sottocateg = intval($_POST['sottocateg']);

    $sql = "INSERT INTO blog (titolo, descrizione, id_utente, categ) VALUES ('$titolo', '$descrizione', '$id_utente', '$sottocateg')";

    if ($conn->query($sql) === TRUE) {
        // Blog creato con successo, reindirizza alla pagina dei blog
        header("Location: blogs.php");
        exit;
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }
}

// Preleva le categorie per il menu a tendina
$cat_query = "SELECT id_cat, tipo FROM categoria WHERE cat_padre = 0";
$cat_result = $conn->query($cat_query);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovo Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }

        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Crea un Nuovo Blog</h1>

        <?php if (!$showForm) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <div id="createBlogForm" <?php if (!$showForm) echo 'class="hidden"'; ?>>
            <form action="nuovo_blog.php" method="POST">
                <div class="form-group">
                    <label for="titolo">Titolo</label>
                    <input type="text" class="form-control" id="titolo" name="titolo" required>
                </div>
                <div class="form-group">
                    <label for="descrizione">Descrizione</label>
                    <textarea class="form-control" id="descrizione" name="descrizione" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="categ">Categoria</label>
                    <select class="form-control" id="categ" name="categ" required>
                        <option value="">Seleziona una categoria</option>
                        <?php
                        if ($cat_result->num_rows > 0) {
                            while ($cat_row = $cat_result->fetch_assoc()) {
                                echo '<option value="' . $cat_row['id_cat'] . '">' . $cat_row['tipo'] . '</option>';
                            }
                        } else {
                            echo '<option value="">Nessuna categoria disponibile</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sottocateg">Sottocategoria</label>
                    <select class="form-control" id="sottocateg" name="sottocateg" required>
                        <option value="">Seleziona una sottocategoria</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Crea Blog</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categ').change(function() {
                var categoria_id = $(this).val();
                $.ajax({
                    url: 'lista_sottocategorie.php', // URL del file PHP che gestisce la chiamata
                    method: 'POST',
                    data: {
                        categoria_id: categoria_id
                    },
                    success: function(response) {
                        $('#sottocateg').html(
                            response); // Aggiorna le opzioni della tendina delle sottocategorie
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>