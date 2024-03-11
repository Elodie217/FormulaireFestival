// début code Salome
// récupération des 3 blocs du formulaire
let blocReservation = document.querySelector("#reservation");

let blocOptions = document.querySelector("#options");

blocOptions.classList.add("hidden");

let blocCoordonnees = document.querySelector("#coordonnees");
blocCoordonnees.classList.add("hidden");

let NombrePlaces = document.querySelector("#NombrePlaces");

let choixJour1 = document.querySelector("#choixJour1");
let choixJour2 = document.querySelector("#choixJour2");
let choixJour3 = document.querySelector("#choixJour3");

let choixJour12 = document.querySelector("#choixJour12");
let choixJour23 = document.querySelector("#choixJour23");

let pass3Jour = document.querySelector("#pass3jours");
let pass1jourreduit = document.querySelector("#pass1jourreduit");
let pass2joursreduit = document.querySelector("#pass2joursreduit");
let pass3joursreduit = document.querySelector("#pass3joursreduit");

/**
 * [Passer de la page Réservation à la page Option si le nombre de réservation est rentré et si une formule est cochée]
 *
 * @param   {[string]}  blocACacher    [Bloc A Cacher ]
 * @param   {[string]}  blocAAfficher  [Bloc A Afficher ]
 *
 */
function suivant(blocACacher, blocAAfficher) {
  if (NombrePlaces.value > 0) {
    if (
      choixJour1.checked === true ||
      choixJour2.checked === true ||
      choixJour3.checked === true ||
      choixJour12.checked === true ||
      choixJour23.checked === true ||
      pass3jours.checked === true ||
      pass1jourreduit.checked === true ||
      pass2joursreduit.checked === true ||
      pass3joursreduit.checked === true
    ) {
      blocACacher.classList.add("hidden");
      blocAAfficher.classList.remove("hidden");
    } else {
      //Message erreur jour choisi
      document.querySelector(".messageErreurReservation").innerText =
        "Merci de choisir une formule";
    }
  } else {
    // Message erreur réservation
    document.querySelector(".messageErreurReservation").innerText =
      "Merci d'indiquer le nombre de réservation souhaité";
  }
}


let nombreCasquesEnfants = document.querySelector("#nombreCasquesEnfants");
let NombreLugesEte = document.querySelector("#NombreLugesEte");

function suivant2(blocACacher, blocAAfficher) {
  if (nombreCasquesEnfants.value < 0) {
    // Message erreur casque
    document.querySelector(".messageErreurCasques").innerText =
      "Merci d'indiquer le nombre de casque souhaité";
  } else if (NombreLugesEte.value < 0) {
    // Message erreur luge
    document.querySelector(".messageErreurLuge").innerText =
      "Merci d'indiquer le nombre de descente souhaité";
  } else {
    blocACacher.classList.add("hidden");
    blocAAfficher.classList.remove("hidden");
  }
}

// fin code Salome

// code Aubin

let tarifreduit = document.querySelector("#tarifreduitRadio");
let pass1Jour = document.querySelector("#pass1jour");
let pass2Jour = document.querySelector("#pass2jours");
let displayPass1Jour = document.querySelector("#pass1jourDate");
let displayPass2Jour = document.querySelector("#pass2joursDate");
let displayTarifReduit = document.querySelector("#tarifreduit");
let divPass1Jour = document.querySelector(".divPass1Jour");
let divPass2Jours = document.querySelector(".divPass2Jours");
let divPass3Jours = document.querySelector(".divPass3Jours");

tarifreduit.addEventListener("click", function () {
  if (tarifreduit.checked === true) {
    displayPass1Jour.classList.add("tarifHidden");
    displayPass2Jour.classList.add("tarifHidden");
    divPass1Jour.classList.add("tarifHidden");
    divPass2Jours.classList.add("tarifHidden");
    divPass3Jours.classList.add("tarifHidden");
    displayTarifReduit.classList.remove("tarifHidden");
  } else {
    divPass1Jour.classList.remove("tarifHidden");
    divPass2Jours.classList.remove("tarifHidden");
    divPass3Jours.classList.remove("tarifHidden");
    displayTarifReduit.classList.add("tarifHidden");
  }
});
pass1Jour.addEventListener("click", function () {
  displayTarifReduit.classList.add("tarifHidden");
  displayPass2Jour.classList.add("tarifHidden");
  displayPass1Jour.classList.remove("tarifHidden");
});
pass2Jour.addEventListener("click", function () {
  displayTarifReduit.classList.add("tarifHidden");
  displayPass1Jour.classList.add("tarifHidden");
  displayPass2Jour.classList.remove("tarifHidden");
});
pass3Jour.addEventListener("click", function () {
  displayPass1Jour.classList.add("tarifHidden");
  displayPass2Jour.classList.add("tarifHidden");
});

// faire la docstring de la fonction

function precedent(blocACacher, blocAAfficher) {

  blocACacher.classList.add("hidden");
  blocAAfficher.classList.remove("hidden");
}
// fin code Aubin

// début code Elodie

//Réservation
let pass1jour = document.querySelector("#pass1jour");
let pass2jours = document.querySelector("#pass2jours");
let pass3jours = document.querySelector("#pass3jours");

pass1jour.addEventListener("change", () => {
  decocher(pass1jour, pass2jours);
  decocher(pass1jour, pass3jours);
});
pass2jours.addEventListener("change", () => {
  decocher(pass2jours, pass1jour);
  decocher(pass2jours, pass3jours);
});
pass3jours.addEventListener("change", () => {
  decocher(pass3jours, pass2jours);
  decocher(pass3jours, pass1jour);
});

choixJour1.addEventListener("change", () => {
  decocher(choixJour1, choixJour2);
  decocher(choixJour1, choixJour3);
});
choixJour2.addEventListener("change", () => {
  decocher(choixJour2, choixJour1);
  decocher(choixJour2, choixJour3);
});
choixJour3.addEventListener("change", () => {
  decocher(choixJour3, choixJour1);
  decocher(choixJour3, choixJour2);
});

choixJour12.addEventListener("change", () => {
  decocher(choixJour12, choixJour23);
});
choixJour23.addEventListener("change", () => {
  decocher(choixJour23, choixJour12);
});

//Option
let tenteNuit1 = document.querySelector("#tenteNuit1");
let tenteNuit2 = document.querySelector("#tenteNuit2");
let tenteNuit3 = document.querySelector("#tenteNuit3");
let tenteTroisNuits = document.querySelector("#tente3Nuits");

let vanNuit1 = document.querySelector("#vanNuit1");
let vanNuit2 = document.querySelector("#vanNuit2");
let vanNuit3 = document.querySelector("#vanNuit3");
let vanTroisNuits = document.querySelector("#van3Nuits");

let enfantsOui = document.querySelector("input[name=enfantsOui]");
let enfantsNon = document.querySelector("input[name=enfantsNon]");
let casqueEnfant = document.querySelector(".casqueEnfant");

tenteNuit1.addEventListener("change", () => {
  decocher(tenteNuit1, tenteTroisNuits);
  decocher3nuit("tente");
});
tenteNuit2.addEventListener("change", () => {
  decocher(tenteNuit2, tenteTroisNuits);
  decocher3nuit("tente");
});
tenteNuit3.addEventListener("change", () => {
  decocher(tenteNuit3, tenteTroisNuits);
  decocher3nuit("tente");
});
tenteTroisNuits.addEventListener("change", () => {
  decocher(tenteTroisNuits, tenteNuit1);
  decocher(tenteTroisNuits, tenteNuit2);
  decocher(tenteTroisNuits, tenteNuit3);
});

vanNuit1.addEventListener("change", () => {
  decocher(vanNuit1, vanTroisNuits);
  decocher3nuit("van");
});
vanNuit2.addEventListener("change", () => {
  decocher(vanNuit2, vanTroisNuits);
  decocher3nuit("van");
});
vanNuit3.addEventListener("change", () => {
  decocher(vanNuit3, vanTroisNuits);
  decocher3nuit("van");
});
vanTroisNuits.addEventListener("change", () => {
  decocher(vanTroisNuits, vanNuit1);
  decocher(vanTroisNuits, vanNuit2);
  decocher(vanTroisNuits, vanNuit3);
});

enfantsOui.addEventListener("change", () => {
  decocher(enfantsOui, enfantsNon);
  if (enfantsOui.checked === true) {
    casqueEnfant.classList.remove("tarifHidden");
  } else {
    casqueEnfant.classList.add("tarifHidden");
  }
});
enfantsNon.addEventListener("change", () => {
  decocher(enfantsNon, enfantsOui);
  if (enfantsNon.checked === true) {
    casqueEnfant.classList.add("tarifHidden");
  }
});

/**
 * [Decocher : permet de décocher une proposition]
 *
 * @param   {[string]}  boutoncoche      [Bouton coché par la personne]
 * @param   {[string]}  boutonadechoche  [Bouton à dechoché car un autre est coché]
 */
function decocher(boutoncoche, boutonadechoche) {
  if (boutoncoche.checked === true) {
    boutonadechoche.checked = false;
  }
}

function decocher3nuit(tenteouvan) {
  if (tenteouvan === "tente") {
    if (
      tenteNuit1.checked === true &&
      tenteNuit2.checked === true &&
      tenteNuit3.checked === true
    ) {
      tenteNuit1.checked = false;
      tenteNuit2.checked = false;
      tenteNuit3.checked = false;
      tenteTroisNuits.checked = true;
    }
  }
  if (tenteouvan === "van") {
    if (
      vanNuit1.checked === true &&
      vanNuit2.checked === true &&
      vanNuit3.checked === true
    ) {
      vanNuit1.checked = false;
      vanNuit2.checked = false;
      vanNuit3.checked = false;
      vanTroisNuits.checked = true;
    }
  }
}

// fin code Elodie
