/*
    File: Carrello.java

    Autore: Alessandro Condelllo
    Ultima modifica: 13/04/2021
 */
package com.example.musica;

import java.util.ArrayList;

public class Carrello {
    ArrayList<Brano> brani;

    public Carrello() {
        brani = new ArrayList<>();
    }

    public ArrayList<Brano> getBrani() {
        return brani;
    }

    public int nBrani() {
        return brani.size();
    }

    public void aggiungi(Brano a) {
        brani.add(a);
    }

    public void elimina(int codice) {
        if (this.contains(codice))
            brani.remove(this.brani.indexOf(this.brani.stream().filter(br -> br.codice == codice).findFirst().get()));
    }

    public boolean contains(int codice) {
        return brani.stream().anyMatch(br -> br.codice == codice);
    }

    public double prendiCosto() {
        return brani.stream().mapToDouble(v -> v.prezzo).sum();
    }
}
