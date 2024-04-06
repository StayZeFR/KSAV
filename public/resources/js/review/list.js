$(document).ready(function() {

    const btnAction = (id) => {
        let html = "<div class='slds-dropdown-trigger slds-dropdown-trigger_click action-menu'>" +
                    "<button class='slds-button slds-button_icon slds-button_icon-border-filled' onclick='toggleMenu(this)'>" +
                    "<svg class='slds-button__icon' aria-hidden='true'>" +
                    "<use xlink:href='/resources/assets/icons/symbols.svg#down'></use>" +
                    "</svg>" +
                    "<span class='slds-assistive-text'>Show More</span>" +
                    "</button>" +
                    "<div class='slds-dropdown slds-dropdown_left'>" +
                    "<ul class='slds-dropdown__list' role='menu' aria-label='Show More'>" +
                    "<li class='slds-dropdown__item' role='presentation'>" +
                    "<a href='/reviews/" + id + "' role='menuitem' tabindex='0'>" +
                    "<span class='slds-truncate'>Visualiser</span>" +
                    "</a>" +
                    "</li>" +
                    "</ul>" +
                    "</div>" +
                    "</div>";
        return html;
    }

    $("#review-datatable").DataTable({
        language: {
            url: "/resources/libs/datatables/French.json"
        },
        data: data,
        responsive: true,
        columns: [
            { title: "N°Reservation", data: "ID_RESERVATION" },
            { title: "Voyage", data: "ID_VOYAGE", render: function(data, type, row) {
                return data + " - " + row["NOM_MODELEVOYAGE"]; 
            }},
            { title: "Client", data: "ID_CLIENT", render: function(data, type, row) {
                return data + " - " + row["NOM_CLIENT"] + " " +  row["PRENOM_CLIENT"] ; 
            }},
            { title: "Date Avis", data: "DATE_AVIS", render: function(data, type, row) {
                return dateToFrench(data);
            }},
            { title: "Action", data: "ID_AVIS", render: function(data, type, row) {
                return btnAction(data);
            }},
        ]
    });

});