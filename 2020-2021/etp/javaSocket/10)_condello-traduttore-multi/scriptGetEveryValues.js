// Go to https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
// paste this:
// https://stackoverflow.com/questions/22097155/javascript-get-entire-2nd-column
function getColumn(table_id, col) {
    var tab = document.getElementById(table_id);
    var n = tab.rows.length;
    var i, s = null, tr, td;

    // First check that col is not less then 0
    if (col < 0) {
        return null;
    }

    for (i = 0; i < n; i++) {
        tr = tab.rows[i];
        if (tr.cells.length > col) { // Check that cell exists before you try
            td = tr.cells[col];      // to access it.
            s += ';' + td.innerText;
        } // Here you could say else { return null; } if you want it to fail
          // when requested column is out of bounds. It depends.
    }
    return s;
}
var isoName = getColumn("Table", 2);
var code = getColumn("Table", 4);
// Siccome vogliamo i nomi in italiano, copiamo e incolliamo "isoName" dentro il traduttore
// https://translate.google.it/?sl=en&tl=it&text=null%3BISO%20language%20name%3BAbkhazian%3BAfar%3BAfrikaans%3BAkan%3BAlbanian%3BAmharic%3BArabic%3BAragonese%3BArmenian%3BAssamese%3BAvaric%3BAvestan%3BAymara%3BAzerbaijani%3BBambara%3BBashkir%3BBasque%3BBelarusian%3BBengali%3BBihari%20languages%3BBislama%3BBosnian%3BBreton%3BBulgarian%3BBurmese%3BCatalan%2C%20Valencian%3BChamorro%3BChechen%3BChichewa%2C%20Chewa%2C%20Nyanja%3BChinese%3BChuvash%3BCornish%3BCorsican%3BCree%3BCroatian%3BCzech%3BDanish%3BDivehi%2C%20Dhivehi%2C%20Maldivian%3BDutch%2C%20Flemish%3BDzongkha%3BEnglish%3BEsperanto%3BEstonian%3BEwe%3BFaroese%3BFijian%3BFinnish%3BFrench%3BFulah%3BGalician%3BGeorgian%3BGerman%3BGreek%2C%20Modern%20(1453%E2%80%93)%3BGuarani%3BGujarati%3BHaitian%2C%20Haitian%20Creole%3BHausa%3BHebrew%3BHerero%3BHindi%3BHiri%20Motu%3BHungarian%3BInterlingua%20(International%20Auxiliary%20Language%20Association)%3BIndonesian%3BInterlingue%2C%20Occidental%3BIrish%3BIgbo%3BInupiaq%3BIdo%3BIcelandic%3BItalian%3BInuktitut%3BJapanese%3BJavanese%3BKalaallisut%2C%20Greenlandic%3BKannada%3BKanuri%3BKashmiri%3BKazakh%3BCentral%20Khmer%3BKikuyu%2C%20Gikuyu%3BKinyarwanda%3BKirghiz%2C%20Kyrgyz%3BKomi%3BKongo%3BKorean%3BKurdish%3BKuanyama%2C%20Kwanyama%3BLatin%3BLuxembourgish%2C%20Letzeburgesch%3BGanda%3BLimburgan%2C%20Limburger%2C%20Limburgish%3BLingala%3BLao%3BLithuanian%3BLuba-Katanga%3BLatvian%3BManx%3BMacedonian%3BMalagasy%3BMalay%3BMalayalam%3BMaltese%3BMaori%3BMarathi%3BMarshallese%3BMongolian%3BNauru%3BNavajo%2C%20Navaho%3BNorth%20Ndebele%3BNepali%3BNdonga%3BNorwegian%20Bokm%C3%A5l%3BNorwegian%20Nynorsk%3BNorwegian%3BSichuan%20Yi%2C%20Nuosu%3BSouth%20Ndebele%3BOccitan%3BOjibwa%3BChurch%C2%A0Slavic%2C%20Old%20Slavonic%2C%20Church%20Slavonic%2C%20Old%20Bulgarian%2C%20Old%C2%A0Church%C2%A0Slavonic%3BOromo%3BOriya%3BOssetian%2C%20Ossetic%3BPunjabi%2C%20Panjabi%3BPali%3BPersian%3BPolish%3BPashto%2C%20Pushto%3BPortuguese%3BQuechua%3BRomansh%3BRundi%3BRomanian%2C%20Moldavian%2C%20Moldovan%3BRussian%3BSanskrit%3BSardinian%3BSindhi%3BNorthern%20Sami%3BSamoan%3BSango%3BSerbian%3BGaelic%2C%20Scottish%20Gaelic%3BShona%3BSinhala%2C%20Sinhalese%3BSlovak%3BSlovenian%3BSomali%3BSouthern%20Sotho%3BSpanish%2C%20Castilian%3BSundanese%3BSwahili%3BSwati%3BSwedish%3BTamil%3BTelugu%3BTajik%3BThai%3BTigrinya%3BTibetan%3BTurkmen%3BTagalog%3BTswana%3BTonga%20(Tonga%20Islands)%3BTurkish%3BTsonga%3BTatar%3BTwi%3BTahitian%3BUighur%2C%20Uyghur%3BUkrainian%3BUrdu%3BUzbek%3BVenda%3BVietnamese%3BVolap%C3%BCk%3BWalloon%3BWelsh%3BWolof%3BWestern%20Frisian%3BXhosa%3BYiddish%3BYoruba%3BZhuang%2C%20Chuang%3BZulu&op=translate
// Facciamo un veloce controllo che i dati siano gli stessi
/* isoName.split(";").length == code.split(";").length */
// Sono tutti e due 186
// Creiamo il nostro file
var ris = "";
var codeArray = code.split(";");
var nameArray = isoName.split(";");
for(var i = 2; i < nameArray.length; i++){
    ris += codeArray[i] + "=" + nameArray[i] + "\n";
}
ris = ris.substring(0, ris.length - 1);
// Per comodità, sostituiamo il ; con un a capo
risArray = ris.split(";")