<?php
// Includi il file di connessione al database
include 'connection.php';
include 'header.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Verifica se l'utente è premium
$email_utente = $_SESSION['email'];
$utente_query = "SELECT premium, id_utente FROM utente WHERE email = '$email_utente'";
$utente_result = $conn->query($utente_query);

if ($utente_result->num_rows > 0) {
    $utente = $utente_result->fetch_assoc();
    $is_premium = $utente['premium'] == 1;
    $id_utente = $utente['id_utente'];
} else {
    echo "Errore: utente non trovato.";
    exit;
}

// Gestione dell'invio del modulo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titolo_post = $conn->real_escape_string($_POST['titolo_post']);
    $testo = $conn->real_escape_string($_POST['testo']);
    $data_ora = date('Y-m-d H:i:s');
    $cod_blog = intval($_POST['cod_blog']);
    $id_utente = $utente['id_utente']; // Presupponendo che l'ID utente sia memorizzato nella sessione

    // Caricamento delle immagini
    $img1 = '';
    $img2 = '';
    if ($_FILES['img1']['error'] === UPLOAD_ERR_OK) {
        $img1 = $_FILES['img1']['name'];
        move_uploaded_file($_FILES['img1']['tmp_name'], 'uploads/' . $img1);
    }
    if ($_FILES['img2']['error'] === UPLOAD_ERR_OK) {
        $img2 = $_FILES['img2']['name'];
        move_uploaded_file($_FILES['img2']['tmp_name'], 'uploads/' . $img2);
    }

    // Aggiungi il font se l'utente è premium
    $id_mod = 0;
    if ($is_premium && isset($_POST['id_mod'])) {
        $id_mod = intval($_POST['id_mod']);
    }

    $sql = "INSERT INTO post (titolo_post, testo, data_ora, img1, img2, cod_blog, id_utente, id_mod) VALUES ('$titolo_post', '$testo', '$data_ora', '$img1', '$img2', '$cod_blog', '$id_utente', '$id_mod')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }
}

// Preleva i blog di cui l'utente è autore o coautore per il menu a tendina
$blog_query = "SELECT DISTINCT blog.cod_blog, blog.titolo 
               FROM blog 
               LEFT JOIN coautori ON blog.cod_blog = coautori.id_blog 
               WHERE blog.id_utente = $id_utente OR coautori.id_utente = $id_utente";
$blog_result = $conn->query($blog_query);


// Preleva i font per il menu a tendina se l'utente è premium
$fonts = [];
if ($is_premium) {
    $font_query = "SELECT id_mod, layout FROM modelli";
    $font_result = $conn->query($font_query);
    if ($font_result->num_rows > 0) {
        while ($font_row = $font_result->fetch_assoc()) {
            $fonts[] = $font_row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovo Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1 class="mt-4">Crea un Nuovo Post</h1>
        <form action="nuovo_post.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titolo_post">Titolo</label>
                <input type="text" class="form-control" id="titolo_post" name="titolo_post" required>
            </div>
            <div class="form-group">
                <label for="testo">Testo</label>
                <textarea class="form-control" id="testo" name="testo" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="img1">Immagine 1</label>
                <input type="file" class="form-control-file" id="img1" name="img1">
            </div>
            <div class="form-group">
                <label for="img2">Immagine 2</label>
                <input type="file" class="form-control-file" id="img2" name="img2">
            </div>
            <div class="form-group">
                <label for="cod_blog">Seleziona il Blog</label>
                <select class="form-control" id="cod_blog" name="cod_blog" required>
                    <?php
                    if ($blog_result->num_rows > 0) {
                        while ($blog_row = $blog_result->fetch_assoc()) {
                            echo '<option value="' . $blog_row['cod_blog'] . '">' . $blog_row['titolo'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Nessun blog disponibile</option>';
                    }
                    ?>
                </select>
            </div>
            <?php if ($is_premium) { ?>
            <div class="form-group">
                <label for="id_mod">Seleziona il Font</label>
                <select class="form-control" id="id_mod" name="id_mod">
                    <?php foreach ($fonts as $font) : ?>
                    <option value="<?php echo $font['id_mod']; ?>"><?php echo $font['layout']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php } else { ?>
            <div class="form-group">
                <a class="btn btn-warning" href="profilo.php">Diventa premium per selezionare il tuo font preferito!</a>
            </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Crea Post</button>
        </form>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>