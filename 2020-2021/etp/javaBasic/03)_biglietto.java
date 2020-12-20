package com.company;


import java.util.*;

public class Main {

    static final Map<String, Integer> sconti = new HashMap<String, Integer>() {{
        put("nessuno", 0);
        put("pensionato", 10);
        put("studenti", 15);
        put("disoccupati", 25);
    }};

    public static void main(String[] args) {

        Scanner s = new Scanner(System.in);

        Map<Character, String> riferimento = new HashMap<>();

        System.out.print("Prezzo: ");
        float prezzo = s.nextFloat();
        System.out.println("Categorie:");
        for( String categoria : sconti.keySet() ) {
            System.out.format("%s : %c\n", categoria, categoria.charAt(0));
            riferimento.put(categoria.charAt(0), categoria);
        }
        System.out.print("Scelta: ");
        Scanner f = new Scanner(System.in);
        char scelta = f.nextLine().charAt(0);

        int sconto_percentuale = sconti.get(riferimento.get(scelta));

        float sconto = sconto_percentuale == 0 ? 0 : ((float) sconti.get(riferimento.get(scelta)) / 100 * prezzo);

        System.out.format("Prezzo: %.2f", + prezzo - sconto);





    }

}


