<?php
    require 'elements/header.php';
    // require 'data/oeuvres.php';
    require 'data/bdd.php';
    
    // Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
    if(empty($_GET['id'])) {
        header('Location: index.php');
    }

    $requete = connexion();
    $response = $requete->prepare('SELECT * FROM oeuvres WHERE id = ?');
    $response->execute([$_GET['id']]);
    $oeuvres = $response->fetchAll();

    $oeuvre = null;

    // On parcourt les oeuvres du tableau afin de rechercher celle qui a l'id précisé dans l'URL
    foreach($oeuvres as $item) {
        // intval permet de transformer l'id de l'URL en un nombre (exemple : "2" devient 2)
        if($item['id'] === intval($_GET['id'])) {
            $oeuvre = $item;
            break; // On stoppe le foreach si on a trouvé l'oeuvre
        }
    }

    // Si aucune oeuvre trouvé, on redirige vers la page d'accueil
    if(is_null($oeuvre)) {
        header('Location: index.php');
    }
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'elements/footer.php'; ?>
