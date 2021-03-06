<?php

include_once('../../core/init.php');
include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../database/QueryBuilder.php');
include_once('../../models/Genre.php');

$genre = Genre::filter([
    "orderby" => $_POST['orderby'],
    "nama" => $_POST['genre'],
    "id" => $_POST['id']
]);

echo json_encode($genre);