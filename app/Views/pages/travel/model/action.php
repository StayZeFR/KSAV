<?= $this->extend("_pattern") ?>

<?= $this->section("main") ?>

<?= $this->include("templates/navigation") ?>

    <div class="slds-box" style="width: 95% !important; background-color: white; margin: auto; margin-top: 20px;">
        <div style="display: flex; flex-direction: row; justify-content: space-between;">
            <h2 class="slds-text-heading_medium">
                <?= ($action == "add" ? "Ajouter d'une destination" : ("Modifier une destination : " . $id)) ?>
            </h2>
        </div>
        <hr style="margin: 30px 0;">
        <form action="<?= ($action == "add" ? url_to("modelTravelAdd") : url_to("modelTravelEdit", $id)) ?>" method="post">
            <div class="slds-grid slds-grid_vertical">
                <div class="slds-col">
                    <div class="slds-grid slds-gutters">
                        <div class="slds-col">
                            <div class="slds-grid slds-grid_vertical">
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="name_model-travel">Nom<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <input type="text" name="name_model-travel" id="name_model-travel" class="slds-input" value="<?= ($action == "add" ? "" : $data["NOM"]) ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="destination_model-travel">Destination<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <input type="text" name="destination_model-travel" id="destination_model-travel" class="slds-input" value="<?= ($action == "add" ? "" : $data["DESTINATION"]) ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="services_model-travel">Prestations<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <div class="slds-select_container">
                                                <select multiple class="slds-select" name="services_model-travel[]" id="services_model-travel" style="height:150px;" required>
                                                    <?php
                                                        foreach ($services as $service) {
                                                            echo "<option value='" . $service["IDPRESTATION"] . "' " . ($action == "add" ? "" : (in_array($service["IDPRESTATION"], $data["SERVICES"]) ? "selected" : "")) . ">" . $service["LIBELLE"] . "</option>";
                                                        } 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slds-col">
                            <div class="slds-grid slds-grid_vertical">
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="type_model-travel">Type de voyage<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <div class="slds-select_container">
                                                <select class="slds-select" name="type_model-travel" id="type_model-travel" required>
                                                    <option value="">-- Sélectionner un type de voyage --</option>
                                                    <?php
                                                        foreach ($typesVoyages as $typeVoyage) {
                                                            echo "<option value='" . $typeVoyage["IDTYPEVOYAGE"] . "' " . ($action == "add" ? "" : ($typeVoyage["IDTYPEVOYAGE"] == $data["IDTYPEVOYAGE"] ? "selected" : "")) . ">" . $typeVoyage["LIBELLE"] . "</option>";
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
                                        <label class="slds-form-element__label" for="touroperator_model-travel">Tour opérateur<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <input type="text" name="touroperator_model-travel" id="touroperator_model-travel" class="slds-input" value="<?= ($action == "add" ? "" : $data["TOUROPERATOR"]) ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="description_model-travel">Description<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <textarea name="description_model-travel" id="description_model-travel" class="slds-textarea" style="height: 150px !important; resize: none;" required><?= ($action == "add" ? "" : $data["DESCRIPTION"]) ?></textarea>
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
                            <a href="<?= url_to("modelTravelList") ?>" class="slds-button slds-button_outline-brand">Annuler</a>
                            <input type="submit" class="slds-button slds-button_brand" value="<?= ($action == "add" ? "Ajouter" : "Modifier") ?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?= $this->endSection() ?>