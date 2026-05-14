<?php
require_once 'database.php';

$connection = connectDatabase();
$posts = getFeedPosts($connection);

require __DIR__ . '/view/home.php';