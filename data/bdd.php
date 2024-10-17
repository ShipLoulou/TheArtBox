<?php
require 'data/config.php';

function connexion() {
    try {
        return $mysqlClient = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}