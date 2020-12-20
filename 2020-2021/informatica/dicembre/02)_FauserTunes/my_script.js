function porta_link(obj) {
    window.location = "./canzoni/" + obj.parentNode.children[0].text.replaceAll(" ", "_") + ".mp3";
}
function musica_scelta(obj) {
    nome = obj.parentNode.children[0].text.replaceAll(" ", "_");
    window.location = "./index.php?autore=" + autore + "&canzone=" + nome;
}
