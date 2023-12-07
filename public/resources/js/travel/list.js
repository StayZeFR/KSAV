function deleteTravel(id) {
    deleteData(("<p>Etes vous sure de vouloir supprimer ce voyage : <b>" + id + "</b></p>"), "/travel/" + id + "/delete");
}

$(document).ready(function() {

    const btnAction = (id) => {
        let html = "<div class='slds-dropdown-trigger slds-dropdown-trigger_click'>" +
                    "<button class='slds-button slds-button_icon slds-button_icon-border-filled' onclick='toggleMenu(this)'>" +
                    "<svg class='slds-button__icon' aria-hidden='true'>" +
                    "<use xlink:href='/resources/assets/icons/symbols.svg#down'></use>" +
                    "</svg>" +
                    "<span class='slds-assistive-text'>Show More</span>" +
                    "</button>" +
                    "<div class='slds-dropdown slds-dropdown_left'>" +
                    "<ul class='slds-dropdown__list' role='menu' aria-label='Show More'>" +
                    "<li class='slds-dropdown__item' role='presentation'>" +
                    "<a href='/travel/" + id + "/edit' role='menuitem' tabindex='0'>" +
                    "<span class='slds-truncate'>Modifier</span>" +
                    "</a>" +
                    "</li>" +
                    "<li class='slds-dropdown__item' role='presentation'>" +
                    "<a href='javascript:deleteTravel(" + id + ")' role='menuitem' tabindex='-1'>" +
                    "<span class='slds-truncate'>Supprimer</span>" +
                    "</a>" +
                    "</li>" +
                    "</ul>" +
                    "</div>" +
                    "</div>";
        return html;
    }

    $("#travel-datatable").DataTable({
        language: {
            url: "/resources/libs/datatables/French.json"
        },
        data: data,
        responsive: true,
        columns: [
            { title: "ID Voyage", data: "ID_VOYAGE" },
            { title: "Nom", data: "ID_MODELEVOYAGE", render: function(data, type, row) {
                return data + " - " + row.NOM_MODELEVOYAGE;
            }},
            { title: "Type Voyage", data: "ID_TYPEVOYAGE", render: function(data, type, row) {
                return data + " - " + row.LIBELLE_TYPEVOYAGE;
            }},
            { title: "Destination", data: "DESTINATION_MODELEVOYAGE" },
            { title: "Date de départ", data: "DATEDEPART_VOYAGE", render: function(data, type, row) {
                return dateToFrench(data);
            }},
            { title: "Description", data: "DESCRIPTION_MODELEVOYAGE" },
            { title: "Action", data: "ID_VOYAGE", render: function(data, type, row) {
                return btnAction(data);
            }},
        ]
    });
});