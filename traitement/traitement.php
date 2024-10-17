<?php

require '../data/bdd.php';

$validatedFormData;

$formValidation = match (true) {
    empty($_POST['titre']) 
    || empty($_POST['artiste']) 
    || empty($_POST['image']) 
    || empty($_POST['description'])
    || strlen($_POST['description']) < 3
    || !str_contains($_POST['image'],'https://') => $validatedFormData = false,
    default => $validatedFormData = true
};

if ($validatedFormData === true) {
    $requete = connexion();
    $response = $requete->prepare('INSERT INTO oeuvres(titre, description, artiste, image) VALUES (:titre, :description, :artiste, :image)');
    $response->execute([
        'titre' => strip_tags($_POST['titre']),
        'description' => strip_tags($_POST['description']),
        'artiste' => strip_tags($_POST['artiste']),
        'image' => strip_tags($_POST['image'])
    ]);
    header('Location: ../oeuvre.php?id=' . $requete->lastInsertId());
    exit;
} else {
    header('Location: ../ajouter.php');
    exit;
}
