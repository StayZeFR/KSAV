<?= $this->extend("_pattern") ?>

<?= $this->section("assets") ?>
    <script src="<?= base_url("resources/js/travel/list.js") ?>"></script>

    <script>
        const data = <?= json_encode($travels) ?>;
    </script>
<?= $this->endSection() ?>

<?= $this->section("main") ?>

    <?= $this->include("templates/navigation") ?>

    <div class="slds-box" style="width: 95% !important; background-color: white; margin: auto; margin-top: 20px;">
        <div style="display: flex; flex-direction: row; justify-content: space-between;">
            <h2 class="slds-text-heading_medium">Liste des voyages</h2>
            <a href="<?= url_to("travelViewAdd") ?>" class="slds-button slds-button_brand">Ajouter un voyage</a>
        </div>
        <hr style="margin: 30px 0;">
        <table id="travel-datatable"></table>
    </div>

<?= $this->endSection() ?>