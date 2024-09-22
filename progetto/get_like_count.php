<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id_post = intval($_GET['id_post']);

    $count_query = "SELECT COUNT(*) as like_count FROM likes WHERE id_post = $id_post";
    $count_result = $conn->query($count_query);
    $count = $count_result->fetch_assoc();

    echo $count['like_count'];
}
