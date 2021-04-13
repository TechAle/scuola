package com.example.musica;

public class Brano {
    // codice, titolo, nomeCantante, durata, prezzo
    int codice;
    String titolo;
    String nomeCantante;
    float prezzo;
    int durata;

    public Brano(int codice, String titolo, String nomeCantante, int durata, float prezzo) {
        this.codice = codice;
        this.titolo = titolo;
        this.nomeCantante = nomeCantante;
        this.prezzo = prezzo;
        this.durata = durata;
    }

    public int getCodice() {
        return codice;
    }

    public float getPrezzo() {
        return prezzo;
    }

    public String getNomeCantante() {
        return nomeCantante;
    }

    public String getTitolo() {
        return titolo;
    }

    public int getDurata() {
        return durata;
    }
}
