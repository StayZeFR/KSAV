<?= $this->extend("_pattern") ?>

<?= $this->section("assets") ?>
    <link rel="stylesheet" href="<?= base_url("resources/css/home.css") ?>">
<?= $this->endSection() ?>

<?= $this->section("main") ?>

    <?= $this->include("templates/navigation") ?>

    <div id="main">
        <div>
            <h1>KSAV</h1>
            <p>Application de gestion des avis client et de suivi de la qualité des voyages</p>
        </div>
    </div>

<?= $this->endSection() ?>