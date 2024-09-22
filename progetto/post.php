<?php
// Includi il file di connessione al database
include 'connection.php';
include 'header.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Ottieni l'ID del post dalla query string
if (isset($_GET['id_post'])) {
    $id_post = intval($_GET['id_post']);

    // Query per selezionare il post con l'ID specificato
    $query = "SELECT post.*, utente.nome, utente.cognome, utente.id_utente AS id_autore, blog.cod_blog AS cod_blog, modelli.layout 
              FROM post 
              INNER JOIN utente ON post.id_utente = utente.id_utente 
              INNER JOIN blog ON post.cod_blog = blog.cod_blog
              LEFT JOIN modelli ON post.id_mod = modelli.id_mod 
              WHERE post.id_post = $id_post";
    $result = $conn->query($query);

    // Verifica se il post esiste
    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        echo "Post non trovato.";
        exit;
    }
} else {
    echo "ID del post non specificato.";
    exit;
}

// Verifica se l'utente è l'autore del post o un coautore del blog
$id_utente = $_SESSION['id_utente'];
$id_autore = $post['id_autore'];
$cod_blog = $post['cod_blog'];
$is_autore_or_coautore = ($id_utente == $id_autore);

// Query per verificare se l'utente è un coautore del blog
$query_coautore = "SELECT * FROM coautori WHERE id_blog = ? AND id_utente = ?";
$stmt = $conn->prepare($query_coautore);
$stmt->bind_param('ii', $cod_blog, $id_utente);
$stmt->execute();
$result_coautore = $stmt->get_result();
if ($result_coautore->num_rows > 0) {
    $is_autore_or_coautore = true;
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['titolo_post']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" rel="stylesheet">
    <style>
    .post-content {
        font-family: <?php echo $post['layout'] ? $post['layout']: 'inherit';
        ?>;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4"><?php echo $post['titolo_post']; ?></h1>
        <div class="card mb-4">
            <div class="card-body">
                <?php if ($post['img1'] || $post['img2']) : ?>
                <div class="row">
                    <?php if ($post['img1']) : ?>
                    <div class="col-md-6 mb-2">
                        <img src="uploads/<?php echo $post['img1']; ?>" alt="Immagine 1" class="img-fluid">
                    </div>
                    <?php endif; ?>
                    <?php if ($post['img2']) : ?>
                    <div class="col-md-6 mb-2">
                        <img src="uploads/<?php echo $post['img2']; ?>" alt="Immagine 2" class="img-fluid">
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <p class="card-text post-content"><?php echo $post['testo']; ?></p>
                <p class="card-text"><small class="text-muted">Pubblicato il <?php echo $post['data_ora']; ?> da
                        <?php echo $post['nome'] . ' ' . $post['cognome']; ?></small></p>
                <?php
                // Mostra il pulsante per eliminare o modificare il post se l'utente è autore o coautore
                if ($is_autore_or_coautore) {
                    echo '<form action="elimina_post.php" method="post">';
                    echo '<input type="hidden" name="id_post" value="' . $id_post . '">';
                    echo '<button type="submit" class="btn btn-danger mb-2">Elimina Post</button>';
                    echo '</form>';
                    echo '<button class="btn btn-warning mb-2" id="edit-post-btn">Modifica Post</button>';
                }
                ?>
                <button class="btn btn-primary mb-2" id="like-btn">Mi piace</button>
                <p class="card-text"><small class="text-muted">Il post ha <span id="like-count">0</span> like</small>
                </p>
            </div>
        </div>

        <!-- Modulo di modifica del post -->
        <div class="card mb-4" id="edit-post-form" style="display:none;">
            <div class="card-body">
                <form action="modifica_post.php" method="post">
                    <input type="hidden" name="id_post" value="<?php echo $id_post; ?>">
                    <div class="form-group">
                        <label for="titolo_post">Titolo del Post</label>
                        <input type="text" class="form-control" id="titolo_post" name="titolo_post"
                            value="<?php echo $post['titolo_post']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="testo">Testo del Post</label>
                        <textarea class="form-control" id="testo" name="testo" rows="5"
                            required><?php echo $post['testo']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    <button type="button" class="btn btn-secondary" id="cancel-edit-btn">Annulla</button>
                </form>
            </div>
        </div>

    </div>
    <div class="container">
        <h2 class="mt-4">Commenti</h2>
        <!-- Form per aggiungere un commento -->
        <form id="comment-form">
            <div class="form-group">
                <label for="commento">Aggiungi un commento</label>
                <textarea class="form-control" id="commento" name="commento" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Aggiungi Commento</button>
        </form>
        <div id="comment-section">
            <?php
            // Query per selezionare i commenti relativi al post, ordinati per utenti premium
            $commenti_query = "SELECT commento.*, utente.nome, utente.cognome, utente.premium 
                      FROM commento 
                      INNER JOIN utente ON commento.id_utente = utente.id_utente 
                      WHERE id_post = $id_post
                      ORDER BY utente.premium DESC";
            $commenti_result = $conn->query($commenti_query);

            if ($commenti_result->num_rows > 0) {
                // Visualizza i commenti
                while ($commento = $commenti_result->fetch_assoc()) {
                    echo '<div class="card mb-2 comment" data-id="' . $commento['id_comm'] . '">';
                    echo '<div class="card-body">';
                    // Mostra badge "premium" se l'utente è premium
                    if ($commento['premium']) {
                        echo '<span class="badge badge-warning">Premium</span>';
                    }
                    echo '<p class="card-text">' . $commento['text'] . '</p>';
                    echo '<p class="card-text"><small class="text-muted">Commento di ' . $commento['nome'] . ' ' . $commento['cognome'] . '</small></p>';
                    if ($commento['id_utente'] == $_SESSION['id_utente']) {
                        echo '<button class="btn btn-danger delete-comment-btn" data-id="' . $commento['id_comm'] . '">Elimina</button>';
                        echo '<button class="btn btn-warning edit-comment-btn" data-id="' . $commento['id_comm'] . '">Modifica</button>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Nessun commento presente.</p>';
            }
            ?>
        </div>

        <!-- Modulo di modifica del commento -->
        <div class="card mb-4" id="edit-comment-form" style="display:none;">
            <div class="card-body">
                <form id="edit-comment-form-inner">
                    <input type="hidden" id="edit-comment-id" name="id_comm">
                    <div class="form-group">
                        <label for="edit-commento">Modifica Commento</label>
                        <textarea class="form-control" id="edit-commento" name="commento" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    <button type="button" class="btn btn-secondary" id="cancel-comment-edit-btn">Annulla</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        // Aggiungi commento
        $('#comment-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'aggiungi_commento.php',
                type: 'POST',
                data: {
                    commento: $('#commento').val(),
                    id_post: <?php echo $id_post; ?>
                },
                success: function(data) {
                    $('#comment-section').append(data);
                    $('#commento').val('');
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        });

        // Elimina commento
        $(document).on('click', '.delete-comment-btn', function() {
            var id_comm = $(this).data('id');
            $.ajax({
                url: 'elimina_commento.php',
                type: 'POST',
                data: {
                    id_comm: id_comm
                },
                success: function(data) {
                    $('.comment[data-id="' + id_comm + '"]').remove();
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        });

        // Gestione like
        $('#like-btn').click(function() {
            $.ajax({
                url: 'gestisci_like.php',
                type: 'POST',
                data: {
                    id_post: <?php echo $id_post; ?>
                },
                success: function(data) {
                    $('#like-count').text(data);
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        });

        // Carica il numero di like iniziale
        $.ajax({
            url: 'get_like_count.php',
            type: 'GET',
            data: {
                id_post: <?php echo $id_post; ?>
            },
            success: function(data) {
                $('#like-count').text(data);
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });

        // Modifica post
        $('#edit-post-btn').click(function() {
            $('#edit-post-form').show();
        });

        $('#cancel-edit-btn').click(function() {
            $('#edit-post-form').hide();
        });

        // Modifica commento
        $(document).on('click', '.edit-comment-btn', function() {
            var id_comm = $(this).data('id');
            var text = $(this).closest('.comment').find('.card-text').first().text();
            $('#edit-comment-id').val(id_comm);
            $('#edit-commento').val(text);
            $('#edit-comment-form').show();
        });

        $('#cancel-comment-edit-btn').click(function() {
            $('#edit-comment-form').hide();
        });

        $('#edit-comment-form-inner').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'modifica_commento.php',
                type: 'POST',
                data: {
                    id_comm: $('#edit-comment-id').val(),
                    commento: $('#edit-commento').val()
                },
                success: function(data) {
                    $('.comment[data-id="' + $('#edit-comment-id').val() + '"]').find(
                        '.card-text').first().text($('#edit-commento').val());
                    $('#edit-comment-form').hide();
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        });
    });
    </script>
</body>

</html>