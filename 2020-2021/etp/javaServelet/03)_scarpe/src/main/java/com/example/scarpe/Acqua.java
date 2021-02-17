package com.example.scarpe;

public class Acqua {
    int codice;
    String descrizione;
    double prezzo;

    public Acqua(int codice, String descrizione, double prezzo) {
        this.codice = codice;
        this.descrizione = descrizione;
        this.prezzo = prezzo;
    }
    public int getCodice() {
        return codice;
    }
    public String getDescrizione() {
        return descrizione;
    }
    public double getPrezzo() {
        return prezzo;
    }
}