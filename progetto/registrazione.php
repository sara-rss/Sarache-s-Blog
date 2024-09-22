<?php
// Includi il file di connessione al database
include 'connection.php';

// Definisci una variabile per memorizzare eventuali errori durante il processo di registrazione
$registrationError = '';

// Verifica se il modulo di registrazione è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ottieni i dati dal modulo di registrazione
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Controllo se è stata caricata una foto profilo
    if ($_FILES['foto_profilo']['error'] == UPLOAD_ERR_OK) {
        // Salva il file in una cartella sul server
        $uploadDir = 'uploads/';
        $uploadedFile = $uploadDir . basename($_FILES['foto_profilo']['name']);
        move_uploaded_file($_FILES['foto_profilo']['tmp_name'], $uploadedFile);
    } else {
        // Nessuna foto profilo caricata, impostiamo il valore a NULL
        $uploadedFile = null;
    }

    // Esegui l'hashing della password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query per l'inserimento dei dati nel database
    $query = "INSERT INTO utente (nome, cognome, email, password, foto_prof) VALUES ('$nome', '$cognome', '$email', '$hashedPassword', '$uploadedFile')";

    // Esegui la query
    if ($conn->query($query) === TRUE) {
        // Redirect alla pagina di login o ad altre pagine
        header("Location: login.php");
        exit();
    } else {
        $registrationError = "Errore durante la registrazione: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registrazione</title>

    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <link href="https://cdn.startbootstrap.com/sb-forms-latest/sb-forms.css" rel="stylesheet">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <h2 class="card-title text-center">Registrazione</h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputName">Nome</label>
                        <input type="text" class="form-control" id="inputName" name="nome" placeholder="Inserisci il tuo nome" required>
                    </div>
                    <div class="form-group">
                        <label for="inputLastName">Cognome</label>
                        <input type="text" class="form-control" id="inputLastName" name="cognome" placeholder="Inserisci il tuo cognome" required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Inserisci la tua email" required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Inserisci la tua password" required>
                    </div>
                    <div class="form-group">
                        <label for="inputProfilePicture">Foto Profilo</label>
                        <input type="file" class="form-control-file btn btn-primary" id="inputProfilePicture" name="foto_profilo">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Registrati</button>
                </form>
                <?php
                // Mostra eventuali errori durante la registrazione
                if (!empty($registrationError)) {
                    echo '<div class="alert alert-danger mt-3" role="alert">' . $registrationError . '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>