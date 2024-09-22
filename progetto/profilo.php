<?php
include 'connection.php';
include 'header.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$id_utente = $_SESSION['id_utente'];

// Query per ottenere i dati dell'utente
$query = "SELECT * FROM utente WHERE id_utente = $id_utente";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $utente = $result->fetch_assoc();
    // Assicurati che le chiavi siano definite prima di accedere ai valori
    $nome = isset($utente['nome']) ? $utente['nome'] : '';
    $cognome = isset($utente['cognome']) ? $utente['cognome'] : '';
    $email = isset($utente['email']) ? $utente['email'] : '';
} else {
    echo "Utente non trovato.";
    exit;
}

// Gestione della modifica dei dati utente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-dati'])) {
    $nome = $conn->real_escape_string($_POST['nome']);
    $cognome = $conn->real_escape_string($_POST['cognome']);
    $email = $conn->real_escape_string($_POST['email']);

    // Aggiorna i dati dell'utente nel database
    $update_query = "UPDATE utente SET nome = '$nome', cognome = '$cognome', email = '$email' WHERE id_utente = $id_utente";

    if ($conn->query($update_query) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Dati utente aggiornati con successo.</div>";
        // Aggiorna la variabile di sessione con il nuovo valore dell'email se è stata modificata
        $_SESSION['email'] = $email;
    } else {
        echo "<div class='alert alert-danger' role='alert'>Errore durante l'aggiornamento dei dati utente: " . $conn->error . "</div>";
    }
}

// Gestione dell'upgrade a premium
if (isset($_POST['submit-premium'])) {
    $numero_carta = $conn->real_escape_string($_POST['numero_carta']);
    $scadenza_carta = $conn->real_escape_string($_POST['scadenza_carta']);
    $cvv = $conn->real_escape_string($_POST['cvv']);

    // Esegui il controllo e l'aggiornamento a premium
    if ($numero_carta && $scadenza_carta && $cvv) {

        // Aggiorna l'utente a premium nel database
        $update_premium_query = "UPDATE utente SET premium = 1 WHERE id_utente = $id_utente";

        if ($conn->query($update_premium_query) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Complimenti! Ora sei un utente premium.</div>";
            // Aggiorna la variabile di sessione per riflettere lo stato premium
            $_SESSION['premium'] = 1;
        } else {
            echo "<div class='alert alert-danger' role='alert'>Errore durante l'aggiornamento a utente premium: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Per diventare premium devi inserire tutti i dettagli della carta di credito.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo Utente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1 class="mt-4">Profilo Utente</h1>
        <div class="card mt-4">
            <div class="card-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="cognome">Cognome</label>
                        <input type="text" class="form-control" id="cognome" name="cognome" value="<?php echo $cognome; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit-dati">Aggiorna Dati</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Diventa Premium</h5>
                <?php if ($utente['premium'] == 0) : ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="numero_carta">Numero Carta di Credito</label>
                            <input type="text" class="form-control" id="numero_carta" name="numero_carta" maxlength="16" required>
                        </div>
                        <div class="form-group">
                            <label for="scadenza_carta">Scadenza Carta di Credito</label>
                            <input type="text" class="form-control" id="scadenza_carta" name="scadenza_carta" maxlength="10" required>
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" maxlength="3" required>
                        </div>
                        <button type="submit" class="btn btn-success" name="submit-premium">Diventa Premium</button>
                    </form>
                <?php else : ?>
                    <p>Sei già un utente premium.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>