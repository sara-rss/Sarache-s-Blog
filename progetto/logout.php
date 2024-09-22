<?php
session_start();

// Distrugge la sessione
session_destroy();

// Reindirizza alla pagina di login
header("Location: login.php");
exit;
