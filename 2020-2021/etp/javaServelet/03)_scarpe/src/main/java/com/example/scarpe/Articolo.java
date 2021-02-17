package com.example.scarpe;

public class Articolo {
    int codice;
    String descrizione;
    double costoUnitario;
    int quantita;
    int size;
    String colore;
    public Articolo(int codice, String descrizione, double costoUnitario, int quantita, int size, String colore) {
        this.size = size;
        this.colore = colore;
        this.codice = codice;
        this.descrizione = descrizione;
        this.costoUnitario = costoUnitario;
        this.quantita = quantita;
    }
    public String getColore() {
        return this.colore;
    }
    public int getSize() {
        return size;
    }
    public int getCodice() {
        return codice;
    }
    public String getDescrizione() {
        return descrizione;
    }
    public double getCostoUnitario() {
        return costoUnitario;
    }
    public double getCostoTotale() {
        return costoUnitario * quantita;
    }
    public int getQuantita() {
        return quantita;
    }
}
