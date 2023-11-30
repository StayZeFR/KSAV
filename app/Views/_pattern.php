<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KSAV</title>
    <link rel="stylesheet" href="<?= base_url("resources/libs/salesforce/salesforce-lightning-design-system.css") ?>">
    <link rel="stylesheet" href="<?= base_url("resources/libs/datatables/datatables.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("resources/libs/sweetalert/sweetalert.min.css") ?>">
    <script src="<?= base_url("resources/libs/jquery/jquery.js") ?>"></script>
    <script src="<?= base_url("resources/libs/datatables/datatables.min.js") ?>"></script>
    <script src="<?= base_url("resources/libs/sweetalert/sweetalert.min.js") ?>"></script>
    <script src="<?= base_url("resources/js/navigation.js") ?>"></script>
    <script src="<?= base_url("resources/js/global.js") ?>"></script>
    <?= $this->renderSection("assets") ?>
</head>
<body>
    
    <?= $this->renderSection("main") ?>

</body>
</html>