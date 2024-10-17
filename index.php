<?php
    require 'elements/header.php';
    require 'data/bdd.php';

    $requete = connexion();
    $response = $requete->query('SELECT * FROM oeuvres');
    $oeuvres = $response->fetchAll();

?>
<div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
                <h2><?= $oeuvre['titre'] ?></h2>
                <p class="description"><?= $oeuvre['artiste'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'elements/footer.php'; ?>
