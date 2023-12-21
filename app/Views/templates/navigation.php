<div class="slds-context-bar">
    <div class="slds-context-bar__primary">
        <div
            class="slds-context-bar__item slds-context-bar__dropdown-trigger slds-dropdown-trigger slds-dropdown-trigger_click slds-no-hover">
            <div class="slds-context-bar__icon-action">
                <button class="slds-button slds-icon-waffle_container slds-context-bar__button"
                    title="Icon">
                    <span class="slds-icon-waffle">
                        <span class="slds-r1"></span>
                        <span class="slds-r2"></span>
                        <span class="slds-r3"></span>
                        <span class="slds-r4"></span>
                        <span class="slds-r5"></span>
                        <span class="slds-r6"></span>
                        <span class="slds-r7"></span>
                        <span class="slds-r8"></span>
                        <span class="slds-r9"></span>
                    </span>
                    <span class="slds-assistive-text">Open App Launcher</span>
                </button>
            </div>
            <span class="slds-context-bar__label-action slds-context-bar__app-name">
                <span class="slds-truncate" title="KSAV">KSAV</span>
            </span>
        </div>
    </div>
    <nav class="slds-context-bar__secondary" role="navigation">
        <ul class="slds-grid">
            <li class="slds-context-bar__item <?= $page == "home" ? "slds-is-active" : "" ?>">
                <a href="<?= url_to("homeView") ?>" class="slds-context-bar__label-action">
                    <span class="slds-truncate">Accueil</span>
                </a>
            </li>
            <li class="slds-context-bar__item slds-context-bar__dropdown-trigger slds-dropdown-trigger slds-dropdown-trigger_click <?= $page == "modelTravel" || $page == "instanceTravel" ? "slds-is-active" : "" ?>" onclick="toggleTravel(this)">
                <a class="slds-context-bar__label-action">
                    <span class="slds-truncate">Voyages</span>
                </a>
                <div class="slds-context-bar__icon-action slds-p-left_none">
                    <button class="slds-button slds-button_icon slds-button_icon slds-context-bar__button"
                        aria-haspopup="true">
                        <svg class="slds-button__icon" aria-hidden="true">
                            <use xlink:href="<?= base_url("resources/assets/icons/symbols.svg#chevrondown") ?>"></use>
                        </svg>
                        <span class="slds-assistive-text">Voyages</span>
                    </button>
                </div>
                <div class="slds-dropdown slds-dropdown_right">
                    <ul class="slds-dropdown__list" role="menu">
                        <li class="slds-dropdown__item" role="presentation">
                            <a href="<?= url_to("modelTravelList") ?>" role="menuitem" tabindex="-1">
                                <span class="slds-truncate">Modèle Voyages</span>
                            </a>
                        </li>
                        <li class="slds-dropdown__item" role="presentation">
                            <a href="<?= url_to("travelViewList") ?>" role="menuitem" tabindex="-1">
                                <span class="slds-truncate">Voyages</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="slds-context-bar__item <?= $page == "customer" ? "slds-is-active" : "" ?>">
                <a href="<?= url_to("customerViewList") ?>" class="slds-context-bar__label-action" title="ReviewsCustomers">
                    <span class="slds-truncate">Clients</span>
                </a>
            </li>
            <li class="slds-context-bar__item <?= $page == "review" ? "slds-is-active" : "" ?>">
                <a href="<?= url_to("reviewViewList") ?>" class="slds-context-bar__label-action" title="ReviewsCustomers">
                    <span class="slds-truncate">Avis</span>
                </a>
            </li>
            <li class="slds-context-bar__item">
                <a href="<?= url_to("loginLogout") ?>" class="slds-context-bar__label-action">
                    <span class="slds-truncate">Deconnexion</span>
                </a>
            </li>
        </ul>
    </nav>
</div>