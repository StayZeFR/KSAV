<?= $this->extend("_pattern") ?>

<?= $this->section("main") ?>

    <?= $this->include("templates/navigation") ?>

    <div class="slds-box" style="width: 95% !important; background-color: white; margin: auto; margin-top: 20px;">
        <div style="display: flex; flex-direction: row; justify-content: space-between;">
            <h2 class="slds-text-heading_medium"><?= ($action == "add" ? "Ajouter une instance de voyage" : ("Modifier une instance de voyage : " . $id)) ?></h2>
        </div>
        <hr style="margin: 30px 0;">
        <form action="<?= ($action == "add" ? url_to("travelAdd") : url_to("travelEdit", $id)) ?>" method="post">
            <div class="slds-grid slds-grid_vertical">
                <div class="slds-col">
                    <div class="slds-grid slds-gutters">
                        <div class="slds-col">
                            <div class="slds-grid slds-grid_vertical">
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="model_travel">Modèle Voyage<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <div class="slds-select_container">
                                                <select class="slds-select" name="model_travel" id="model_travel">
                                                    <option value="">-- Sélectionner un modèle de voyage --</option>
                                                    <?php
                                                    foreach ($modelsTravels as $modelTravel) {
                                                        echo "<option value='" . $modelTravel["IDMODELEVOYAGE"] . "' " . ($action == "add" ? "" : ($modelTravel["IDMODELEVOYAGE"] == $data["IDMODELEVOYAGE"] ? "selected" : "")) . ">" . $modelTravel["NOM"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>                                
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="date_travel">Date de départ<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <input type="date" name="date_travel" id="date_travel" class="slds-input" value="<?= ($action == "add" ? "" : $data["DATEDEPART"]) ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="slds-col">
                    <div class="slds-clearfix">
                        <div class="slds-float_right">
                            <a href="<?= url_to("travelViewList") ?>" class="slds-button slds-button_outline-brand">Annuler</a>
                            <input type="submit" class="slds-button slds-button_brand" value="<?= ($action == "add" ? "Ajouter" : "Modifier") ?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?= $this->endSection() ?>