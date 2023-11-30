<?= $this->extend("_pattern") ?>

<?= $this->section("main") ?>

    <?= $this->include("templates/navigation") ?>

    <div class="slds-box" style="width: 95% !important; background-color: white; margin: auto; margin-top: 20px;">
        <div style="display: flex; flex-direction: row; justify-content: space-between;">
            <h2 class="slds-text-heading_medium"><?= ($action == "add" ? "Ajouter un client" : ("Modifier unclient : " . $id)) ?></h2>
        </div>
        <hr style="margin: 30px 0;">
        <form action="<?= ($action == "add" ? url_to("customerAdd") : url_to("customerEdit", $id)) ?>" method="post">
            <div class="slds-grid slds-grid_vertical">
                <div class="slds-col">
                    <div class="slds-grid slds-gutters">
                        <div class="slds-col">
                            <div class="slds-grid slds-grid_vertical">
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="lastname_customer">
                                        Nom<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <input type="text" id="lastname_customer" name="lastname_customer" required class="slds-input" value="<?= ($action == "add" ? "" : $data["NOM"]) ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="address_customer">
                                        Adresse<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <input type="text" id="address_customer" name="address_customer" required class="slds-input" value="<?= ($action == "add" ? "" : $data["ADRESSE"]) ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="phone_customer">
                                        Téléphone<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <input type="text" id="phone_customer" name="phone_customer" required class="slds-input" value="<?= ($action == "add" ? "" : $data["TEL"]) ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slds-col">
                            <div class="slds-grid slds-grid_vertical">
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="firstname_customer">
                                        Prénom<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <input type="text" id="firstname_customer" name="firstname_customer" required class="slds-input" value="<?= ($action == "add" ? "" : $data["PRENOM"]) ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="slds-col">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="email_customer">
                                        Email<abbr class="slds-required">*</abbr></label>
                                        <div class="slds-form-element__control">
                                            <input type="text" id="email_customer" name="email_customer" required class="slds-input" value="<?= ($action == "add" ? "" : $data["EMAIL"]) ?>"/>
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
                            <a href="<?= url_to("customerViewList") ?>" class="slds-button slds-button_outline-brand">Annuler</a>
                            <input type="submit" class="slds-button slds-button_brand" value="<?= ($action == "add" ? "Ajouter" : "Modifier") ?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?= $this->endSection() ?>