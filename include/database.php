<?php

$pdo = new PDO('mysql:host=localhost:8889;dbname=usercrud', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

