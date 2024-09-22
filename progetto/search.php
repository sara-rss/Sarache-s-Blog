<?php
// Includi il file di connessione al database
include 'connection.php';

$query = $_POST['query'];
$type = $_POST['type'];

$searchQuery = "";

switch ($type) {
    case 'post':
        $searchQuery = "SELECT id_post, titolo_post FROM post WHERE titolo_post LIKE '%$query%' OR testo LIKE '%$query%' ORDER BY data_ora DESC";
        break;
    case 'blog':
        $searchQuery = "SELECT cod_blog, titolo FROM blog WHERE titolo LIKE '%$query%' OR descrizione LIKE '%$query%' ORDER BY titolo ASC";
        break;
    case 'user':
        $searchQuery = "SELECT id_utente, nome, cognome FROM utente WHERE nome LIKE '%$query%' OR cognome LIKE '%$query%' ORDER BY nome ASC";
        break;
    case 'category':
        $searchQuery = "SELECT id_cat, tipo FROM categoria WHERE tipo LIKE '%$query%' ORDER BY tipo ASC";
        break;
}

$result = $conn->query($searchQuery);

// Visualizza i risultati della ricerca
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<li class="list-group-item">';
        switch ($type) {
            case 'post':
                echo '<a href="post.php?id_post=' . $row['id_post'] . '">' . $row['titolo_post'] . '</a>';
                break;
            case 'blog':
                echo '<a href="blogs.php?cod_blog=' . $row['cod_blog'] . '">' . $row['titolo'] . '</a>';
                break;
            case 'user':
                echo '<a>' . $row['nome'] . ' ' . $row['cognome'] . '</a>';
                break;
            case 'category':
                echo '<a>' . $row['tipo'] . '</a>';
                break;
        }
        echo '</li>';
    }
} else {
    echo '<li class="list-group-item">Nessun risultato trovato.</li>';
}
