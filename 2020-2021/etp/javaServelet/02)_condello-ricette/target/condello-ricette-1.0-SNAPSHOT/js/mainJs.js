
// Le varie opzioni
var possibilita = ["primi", "secondi", "dessert"];
// Valore default
var defaultPoss = "primi";
// Prendi l'url

var url = new URL(window.location.href).searchParams.get("piatto");
if (url != null)
url = url.toLowerCase();
// Se nell'url abbiamo abboamo una delle possibilità, da la sua scelta, senò usa il valore di default
var decisione = possibilita.includes(url) ? url : defaultPoss;
// Rendiamolo attivo
document.getElementById(decisione).classList.add("active");


<!-- Rendirizziamo a seconda del click -->
function replaceUrlFunc() {
// Controlla se già contiene un valore
var url = window.location.href;
// Prendiamo ciò che il cliente ha scelto
var decisione = window.event.target.text.toLowerCase();
// Se abbiamo qualcosa
if (url.match("piatto=") != null ) {
// Prendiamo l'inizio della sua decisione
var inizio = url.lastIndexOf("piatto=") + 7;
// Prendiamo la fine
var fine = (url.substring(inizio).lastIndexOf("&") === -1) ? url.length : url.substring(inizio).indexOf("&") - inizio;
// Sostituamo
url = url.replace(url.substring(inizio, fine), decisione)
// Senò, vuol dire che il link è vuoto, creiamo noi
}else url += (url.includes("?") ? "" : "?") + (url.includes("=") && url.lastIndexOf("&") !== url.length - 1 ? "&" : "") + "piatto=" + decisione.toLowerCase();
// Rimpiazziamo l'url
window.location.replace(url)
}

// Prendiamo tutti gli elementi con classe piattoDec per fare il listener
var elementi = document.getElementsByClassName("piattoDec");
// Aggiungiamo il listener
for(var i = 0; i < elementi.length; i++)
elementi[i].addEventListener("click", replaceUrlFunc)

var e;
function portaRicetta() {
    e = window.event.target;
    if (!e.classList.contains("col"))
        e = e.parentElement;
    var obbiettivo = e.textContent.trim();
    var t = window.location.href;
    var newUrl = t.substring(0, t.lastIndexOf("/") + 1)
    var sezione = document.getElementsByClassName("active")[0].textContent.trim();
    window.location.href = newUrl + "cibo?sezione=" + sezione + "&cibo=" + obbiettivo;
}