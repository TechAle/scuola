package com.example.scarpe;

import java.util.ArrayList;

public class Carrello {
    ArrayList<Articolo> articoli;
    public Carrello() {
        articoli = new ArrayList<>();
    }
    public ArrayList<Articolo> getArticoli() {
        return articoli;
    }
    public int numeroArticoli() {
        return articoli.size();
    }
    public void aggiungi(Articolo a) {
        articoli.add(a);
    }
    public void elimina(int riga) {
        if (riga > 0 && riga <= articoli.size())
            articoli.remove(riga - 1);
    }
    public double totale() {
        double ris = 0;
        for(Articolo a : articoli)
            ris += a.getCostoTotale();
        return ris;
    }
}