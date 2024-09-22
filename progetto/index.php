<?php
// Includi il file di connessione al database
include 'connection.php';
include 'header.php';

// Query per selezionare tutti i post ordinati per data in ordine decrescente limitando a 10 i post
$query = "SELECT post.*, utente.nome, utente.cognome FROM post INNER JOIN utente ON post.id_utente = utente.id_utente ORDER BY data_ora DESC LIMIT 10";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" rel="stylesheet">
    <style>
    .sidebar {
        border-right: 1px solid #ddd;
        background-color: #343a40;
        /* Colore dello header */
    }

    .sidebar .nav-link {
        color: #fff;
        /* Colore del testo nella sidebar */
    }

    .sidebar .nav-link.active {
        color: #f8f9fa;
    }

    .search-results {
        position: absolute;
        z-index: 1000;
        width: 100%;
        background-color: white;
        border: 1px solid #ddd;
        display: none;
    }

    .search-results li {
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    .search-results li:hover {
        background-color: #f1f1f1;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Navbar laterale -->
            <nav class="col-md-2 d-none d-md-block sidebar navbar-dark bg-dark static-top navbar navbar-expand-lg mt-1">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="blogs.php">
                                Naviga tra i blog
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="nuovo_blog.php">
                                Crea un Blog
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="nuovo_post.php">
                                Crea un Post
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="gestione_coautori.php">
                                Gestisci i coautori
                            </a>
                        </li>

                        <li class="nav-item mt-4">
                            <a class="nav-link">
                                Ricerca
                            </a>
                        </li>

                        <form id="search-form">
                            <input type="text" id="search-input" class="form-control" placeholder="Cerca...">
                            <div class="form-check nav-link ml-4">
                                <input class="form-check-input" type="radio" name="search-type" id="search-post"
                                    value="post" checked>
                                <label class="form-check-label" for="search-post">
                                    Post
                                </label>
                            </div>
                            <div class="form-check nav-link ml-4">
                                <input class="form-check-input" type="radio" name="search-type" id="search-blog"
                                    value="blog">
                                <label class="form-check-label" for="search-blog">
                                    Blog
                                </label>
                            </div>
                            <div class="form-check nav-link ml-4">
                                <input class="form-check-input" type="radio" name="search-type" id="search-user"
                                    value="user">
                                <label class="form-check-label" for="search-user">
                                    Utente
                                </label>
                            </div>
                            <div class="form-check nav-link ml-4">
                                <input class="form-check-input" type="radio" name="search-type" id="search-category"
                                    value="category">
                                <label class="form-check-label" for="search-category">
                                    Categoria
                                </label>
                            </div>
                            <ul class="search-results list-group"></ul>
                        </form>

                    </ul>

                </div>
            </nav>

            <!-- Contenuto principale -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <h1 class="mt-4">Ultimi Post</h1>
                <div class="row" id="posts-container">
                    <?php
                    // Verifica se ci sono post
                    if ($result->num_rows > 0) {
                        // Itera attraverso i risultati della query
                        while ($row = $result->fetch_assoc()) {
                            // Visualizza le informazioni del post
                            echo '<div class="col-md-4 mt-4">';
                            echo '<div class="card">';
                            if (!empty($row['img1'])) {
                                echo '<img src="uploads/' . $row['img1'] . '" class="card-img-top" alt="Immagine del post">';
                            }
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title"><a href="post.php?id_post=' . $row['id_post'] . '">' . $row['titolo_post'] . '</a></h5>';
                            echo '<p class="card-text">' . $row['testo'] . '</p>';
                            echo '<p class="card-text"><small class="text-muted">Pubblicato il ' . $row['data_ora'] . ' da ' . $row['nome'] . ' ' . $row['cognome'] . '</small></p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="col-md-12 mt-4">';
                        echo '<p>Nessun post disponibile al momento.</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Funzione per la ricerca con AJAX
    $(document).ready(function() {
        $('#search-input').on('input', function() {
            var query = $(this).val();
            var searchType = $('input[name="search-type"]:checked').val();
            if (query.length > 0) {
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: {
                        query: query,
                        type: searchType
                    },
                    success: function(data) {
                        $('.search-results').html(data).show();
                    }
                });
            } else {
                $('.search-results').hide();
            }
        });
    });
    </script>
</body>

</html>