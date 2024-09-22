<?php
// Includi il file di connessione al database
include 'connection.php';

// Definisci una variabile per memorizzare eventuali errori durante il processo di login
$loginError = '';

// Verifica se il modulo di login è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ottieni i dati dal modulo di login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query per selezionare l'utente con l'email fornita
    $query = "SELECT * FROM utente WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Utente trovato, verifica la password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password corretta, esegui il login
            session_start();
            $_SESSION['email'] = $row['email'];
            $_SESSION['id_utente'] = $row['id_utente'];
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['cognome'] = $row['cognome'];
            $_SESSION['foto_prof'] = $row['foto_prof'];

            // Redirect alla pagina di index o ad altre pagine protette
            header("Location: index.php");
            exit();
        } else {
            $loginError = "Password errata. Riprova.";
        }
    } else {
        $loginError = "Utente non trovato.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <h2 class="card-title text-center">Login</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email"
                            placeholder="Inserisci la tua email" required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password"
                            placeholder="Inserisci la tua password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <?php
                // Mostra eventuali errori durante il login
                if (!empty($loginError)) {
                    echo '<div class="alert alert-danger mt-3" role="alert">' . $loginError . '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4