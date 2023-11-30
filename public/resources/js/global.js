/**
 * Fonction qui transforme une date au format ISO en date au format français
 * 
 * @param {string} date
 */
function dateToFrench(date) {
    let dateSplit = date.split("-");
    return dateSplit[2] + "/" + dateSplit[1] + "/" + dateSplit[0];
}

/**
 * Fonction permettant de d'ouvrir ou fermer un menu déroulant en fonction de son état actuel (ouvert ou fermé) et de changer l'icône du bouton en conséquence (flèche vers le haut ou vers le bas)
 * 
 * @param {*} element 
 */
function toggleMenu(element) {
    let parent = element.parentElement;
    parent.classList.toggle("slds-is-open");
    let open = parent.classList.contains("slds-is-open");
    element.innerHTML = element.innerHTML.replace(open ? "down" : "up", open ? "up" : "down");
}

/**
 * Fonction permettant 
 * 
 * @param {*} spaces 
 * @param {*} text 
 * @returns String
 */
function setSpaceText(spaces, text) {
    let result = "";
    for (let i = 0; i < text.length; i++) {
        result += (spaces.includes(i) ? (" " + text[i]) : text[i]);
    }
    return result
}