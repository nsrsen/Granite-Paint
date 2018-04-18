<?php
require_once dirname(dirname(__DIR__)) . '/src/bootstrap.php';
$title = substr(__FILE__, strlen(__DIR__ . DIRECTORY_SEPARATOR), strlen(__FILE__));
$body = null;
if(isset($_SESSION['error'])) {
    $body .= '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}

$body .= '
<h2>Submit a payment</h2>
<form action="endpoint.php" method="post">
