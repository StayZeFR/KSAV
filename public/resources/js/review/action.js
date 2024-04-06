/**
 * Fonction qui récupère les prestations d'un modèle de voyage
 * 
 * @param {*} id 
 * @returns 
 */
function getTravelServices(id) {
    let result;
    $.ajax({
        url: "/api/model-travel/" + id + "/services",
        type: "POST",
        async: false,
        success: function (data) {
            result = data;
        }
    });
    return result;
}

/**
 * Fonction qui récupère les voyages d'un modèle de voyage
 * 
 * @param {*} id 
 * @returns 
 */
function getTravelsByID(id) {
    let result;
    $.ajax({
        url: "/api/travels/" + id,
        type: "POST",
        async: false,
        success: function (data) {
            result = data;
        }
    });
    return result;
}

/**
 * Fonction qui récupère les informations d'un voyage en fonction de son ID et affiche les inputs pour les notes
 * 
 * @param {*} id 
 */
function setReviewsInputs(id) {
    if (id !== "") {
        const services = getTravelServices(id);
        let inputs = "";
        services.forEach(function (service) {
            inputs += "<div class='input-review'>" +
                    "<div style='witdh: 300px;'>" +
                    "<span>" + service["LIBELLE_PRESTATION"] + "</span>" +
                    "</div>" +
                    "<div style='width: 300px'>" +
                    "<input name='note_*" + service["ID_PRESTATION"] + "*-review' type='range' class='slds-slider__range' value='0' min='1' max='3' step='1' style='width: 100%;'/>" +
                    "</div>" +
                    "</div>";
        });
        $("#inputs-review").html(inputs);
    } else {
        $("#inputs-review").html("");
    }
}

/**
 * Fonction qui récupère les dates d'un voyage en fonction de son ID et affiche les dates dans un menu déroulant
 * 
 * @param {*} id 
 */
function setDateTravels(id) {
    $("#id_travel-review").prop("disabled", !(id !== ""));
    if (id !== "") {
        const dates = getTravelsByID(id);
        let options = "<option value=''>-- Sélectionner une date --</option>";
        for (let i = 0; i < dates.length; i++) {
            options += "<option value='" + dates[i]["IDVOYAGE"] + "'>" + dateToFrench(dates[i]["DATEDEPART"]) + "</option>";
        }
        $("#id_travel-review").html(options);
    } else {
        $("#id_travel-review").html("");
    }
}

$(document).ready(function () {
    if (error.length > 0) {
        Swal.fire({
            icon: "error",
            title: "Erreur",
            text: error,
            confirmButtonText: "Ok",
        });
    }
});    