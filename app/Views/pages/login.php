<?= $this->extend("_pattern") ?>

<?= $this->section("assets") ?>
    <script src="<?= base_url("resources/js/login.js") ?>"></script>
<?= $this->endSection() ?>

<?= $this->section("main") ?>

<div class="slds-box slds-p-around_xxx-small"
    style="width: 27%; background-color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <div class="slds-grid slds-grid_vertical">
        <div class="slds-col">
            <div class="slds-text-heading_large slds-text-align_center"><b>KSAV</b></div>
        </div>
        <?php
        if (session()->getFlashdata("error") !== NULL) {
        ?>
        <div id="error">
            <br>
            <div class="slds-notify slds-notify_alert slds-alert_error" role="alert">
                <span class="slds-assistive-text">Erreur</span>
                <span class="slds-icon_container slds-icon-utility-error slds-m-right_x-small">
                    <svg class="slds-icon slds-icon_x-small" aria-hidden="true">
                        <use xlink:href="<?= base_url("resources/assets/icons/symbols.svg#error") ?>"></use>
                    </svg>
                </span>
                <h2><?= session()->getFlashdata("error") ?></h2>
                <div class="slds-notify__close">
                    <button class="slds-button slds-button_icon slds-button_icon-small slds-button_icon-inverse" onclick="closeError()">
                        <svg class="slds-button__icon" aria-hidden="true">
                            <use xlink:href="<?= base_url("resources/assets/icons/symbols.svg#close") ?>"></use>
                        </svg>
                        <span class="slds-assistive-text">Fermer</span>
                    </button>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <form action="<?= url_to("loginCheck") ?>" method="post">
            <div class="slds-col slds-m-top_x-large">
                <div class="slds-grid slds-grid_vertical">
                    <div class="slds-col">
                        <div class="slds-form-element">
                            <label class="slds-form-element__label" for="login">Nom d'utilisateur <abbr class="slds-required" title="required">* </abbr></label>
                            <div class="slds-form-element__control">
                                <input type="text" id="login" name="login" required="" class="slds-input" />
                            </div>
                        </div>
                    </div>
                    <div class="slds-col slds-m-top_medium">
                        <div class="slds-form-element">
                        <label class="slds-form-element__label" for="password">Mot de passe <abbr class="slds-required" title="required">* </abbr></label>
                            <div class="slds-form-element__control">
                                <input type="password" id="password" name="password" required="" class="slds-input" />
                            </div>
                        </div>
                    </div>
                    <div class="slds-col slds-m-top_medium">
                        <button class="slds-button slds-button_brand">Se connecter</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>