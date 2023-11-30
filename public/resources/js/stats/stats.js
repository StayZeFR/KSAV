/**
 * Fonction qui récupère les notes moyennes des services et les affiche dans un graphique
 */
function showStatsAverageNotesServices() {
    labels = [];
    data = [];

    avgNotesServices.forEach(function(element) {
        labels.push(element["PRESTATION_LIBELLE"]);
        data.push(element["NOTE_MOYENNE"]);
    });

    const dataChart = {
        labels: labels,
        datasets: [{
            label: "Moyenne des notes par prestation",
            data: data,
            borderWidth: 1
        }]
    };

    const configChart = {
        type: "bar",
        data: dataChart,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const chart = new Chart(
        document.getElementById("chart-1"),
        configChart,
        dataChart
    );
}

/**
 * Fonction qui récupère les notes moyennes des voyages et les affiche dans un graphique
 */
function showStatsAverageNotesTravels() {
    labels = [];
    data = [];

    avgNotesTravels.forEach(function(element) {
        labels.push(element["MODELEVOYAGE_NOM"]);
        data.push(element["NOTE_MOYENNE"]);
    });

    const dataChart = {
        labels: labels,
        datasets: [{
            label: "Moyenne des notes par voyage",
            data: data,
            borderWidth: 1
        }]
    };

    const configChart = {
        type: "bar",
        data: dataChart,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const chart = new Chart(
        document.getElementById("chart-2"),
        configChart,
        dataChart
    );
}

/**
 * Fonction qui récupère les notes moyennes des services d'un voyage
 * 
 * @param {*} id 
 * @returns result
 */
function getNotesServicesByTravel(id) {
    var result = null;
    $.ajax({
        type: "POST",
        url: "/api/stats/travel/" + id,
        async: false,
        
        success: function(data) {
            result = data;
            console.log("DATA : " + JSON.stringify(data));
        },
        error: function(error) {
            console.log(error);
        }
    });
    return result;
}

let chart = null;
/**
 * Fonction qui récupère les notes moyennes des services d'un voyage et les affiche dans un graphique
 */
function showStatsAverageNotesServicesByTravel() {
    avgNotesServicesByTravel = getNotesServicesByTravel(document.getElementById("select-id_travel").value);

    labels = [];
    data = [];

    avgNotesServicesByTravel.forEach(function(element) {
        labels.push(element["PRESTATION_LIBELLE"]);
        data.push(element["NOTE_MOYENNE"]);
    });

    if (chart != null) {
        chart.data.labels = labels;
        chart.data.datasets[0].data = data;
        chart.update();
    } else {
        const dataChart = {
            labels: labels,
            datasets: [{
                label: "Moyenne des notes sur un voyage",
                data: data,
                borderWidth: 1
            }]
        };

        const configChart = {
            type: "bar",
            data: dataChart,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        chart = new Chart(
            document.getElementById("chart-3"),
            configChart,
            dataChart
        );
    }
}

$(document).ready(function() {
    showStatsAverageNotesServices();
    showStatsAverageNotesTravels();
    showStatsAverageNotesServicesByTravel();
});