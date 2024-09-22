<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categoria_id'])) {
    $categoria_id = intval($_POST['categoria_id']);

    // Query per ottenere le sottocategorie in base alla categoria selezionata
    $sottocateg_query = "SELECT id_cat, tipo FROM categoria WHERE cat_padre = ?";
    $stmt = $conn->prepare($sottocateg_query);
    $stmt->bind_param('i', $categoria_id);
    $stmt->execute();
    $sottocateg_result = $stmt->get_result();

    if ($sottocateg_result->num_rows > 0) {
        while ($sottocateg_row = $sottocateg_result->fetch_assoc()) {
            echo '<option value="' . $sottocateg_row['id_cat'] . '">' . $sottocateg_row['tipo'] . '</option>';
        }
    } else {
        echo '<option value="">Nessuna sottocategoria disponibile per questa categoria</option>';
    }
} else {
    echo '<option value="">Errore nel caricamento delle sottocategorie</option>';
}
