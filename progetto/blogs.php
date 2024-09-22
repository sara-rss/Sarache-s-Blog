<?php
include 'connection.php';
include 'header.php';

// Query per ottenere tutti i blog e la loro categoria
$query = "SELECT blog.*, categoria.tipo AS nome_categoria FROM blog 
          INNER JOIN categoria ON blog.categ = categoria.id_cat";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1 class="mt-4">Lista Blog</h1>
        <ul class="list-group mt-4">
            <?php
            // Verifica se ci sono blog
            if ($result->num_rows > 0) {
                // Itera attraverso i risultati della query
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="list-group-item mb-2">';
                    echo '<a href="view_blog.php?id_blog=' . $row['cod_blog'] . '">';
                    echo '<h5>' . $row['titolo'] . '</h5>';
                    echo '</a>';
                    echo '<p>' . $row['descrizione'] . '</p>';
                    echo '<p><strong>Categoria:</strong> ' . $row['nome_categoria'] . '</p>';
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