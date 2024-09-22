<?php
include 'connection.php';
include 'header.php';

// Funzione per ottenere il nome e cognome dell'utente dall'email
function getUserByEmail($email, $conn)
{
    $query = "SELECT * FROM utente WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Aggiungi un coautore
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_coauthor'])) {
    $id_blog = intval($_POST['id_blog']);
    $email = $_POST['email'];

    // Ottieni l'utente dall'email
    $utente = getUserByEmail($email, $conn);
    if ($utente) {
        $id_utente = $utente['id_utente'];

        // Verifica se il coautore esiste già
        $check_query = "SELECT * FROM coautori WHERE id_blog = ? AND id_utente = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param('ii', $id_blog, $id_utente);
        $stmt->execute();
        $check_result = $stmt->get_result();

        if ($check_result->num_rows == 0) {
            // Aggiungi il coautore
            $query = "INSERT INTO coautori (id_blog, id_utente) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ii', $id_blog, $id_utente);
            if ($stmt->execute() === TRUE) {
                echo "Coautore aggiunto con successo.";
            } else {
                echo "Errore durante l'aggiunta del coautore: " . $conn->error;
            }
        } else {
            echo "Questo utente è già un coautore di questo blog.";
        }
    } else {
        echo "Utente non trovato.";
    }
}

// Rimuovi un coautore
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_coauthor'])) {
    $id_blog = intval($_POST['id_blog']);
    $id_utente = intval($_POST['id_utente']);

    $query = "DELETE FROM coautori WHERE id_blog = ? AND id_utente = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $id_blog, $id_utente);
    if ($stmt->execute() === TRUE) {
        echo "Coautore rimosso con successo.";
    } else {
        echo "Errore durante la rimozione del coautore: " . $conn->error;
    }
}

// Ottieni l'email dell'utente loggato
$email_utente = $_SESSION['email'];

// Ottieni i dettagli dell'utente
$utente = getUserByEmail($email_utente, $conn);
if (!$utente) {
    echo "Errore: utente non trovato.";
    exit;
}

$id_utente = $utente['id_utente'];

// Ottieni la lista di tutti i blog di cui l'utente è autore
$query = "SELECT blog.*, categoria.tipo AS categoria_nome 
          FROM blog 
          INNER JOIN categoria ON blog.categ = categoria.id_cat 
          WHERE blog.id_utente = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_utente);
$stmt->execute();
$blog_result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Coautori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Gestione Coautori</h1>

        <h2 class="mt-4">Lista Blog</h2>
        <ul class="list-group mt-4">
            <?php
            if ($blog_result->num_rows > 0) {
                while ($blog = $blog_result->fetch_assoc()) {
                    echo '<li class="list-group-item mb-2">';
                    echo '<h5>' . $blog['titolo'] . ' (' . $blog['categoria_nome'] . ')</h5>';
                    echo '<p>' . $blog['descrizione'] . '</p>';

                    // Form per aggiungere coautore
                    echo '<form action="" method="post" class="form-inline mb-2">';
                    echo '<input type="hidden" name="id_blog" value="' . $blog['cod_blog'] . '">';
                    echo '<input type="email" name="email" class="form-control mr-2" placeholder="Email coautore" required>';
                    echo '<button type="submit" name="add_coauthor" class="btn btn-primary">Aggiungi Coautore</button>';
                    echo '</form>';

                    // Ottieni i coautori del blog
                    $coautori_query = "SELECT utente.* FROM coautori INNER JOIN utente ON coautori.id_utente = utente.id_utente WHERE coautori.id_blog = " . $blog['cod_blog'];
                    $coautori_result = $conn->query($coautori_query);

                    echo '<h6>Coautori:</h6>';
                    echo '<ul class="list-group">';
                    if ($coautori_result->num_rows > 0) {
                        while ($coautore = $coautori_result->fetch_assoc()) {
                            echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                            echo $coautore['nome'] . ' ' . $coautore['cognome'] . ' (' . $coautore['email'] . ')';
                            echo '<form action="" method="post" class="ml-auto">';
                            echo '<input type="hidden" name="id_blog" value="' . $blog['cod_blog'] . '">';
                            echo '<input type="hidden" name="id_utente" value="' . $coautore['id_utente'] . '">';
                            echo '<button type="submit" name="remove_coauthor" class="btn btn-danger btn-sm">Rimuovi</button>';
                            echo '</form>';
                            echo '</li>';
                        }
                    } else {
                        echo '<li class="list-group-item">Nessun coautore aggiunto al momento.</li>';
                    }
                    echo '</ul>';
                    echo '</li>';
                }
            } else {
                echo '<li class="list-group-item">Nessun blog disponibile al momento.</li>';
            }
            ?>
        </ul>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>