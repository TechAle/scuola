package com.company;

import java.io.*;
import java.util.*;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class Main {



    // Nostro dizionario per le classi
    static Map<String, studenti> classi = new HashMap<>();

    // Dentro il dizionrio abbiamo questa classe
    public static class studenti
    {
        // Conterra tutti gli studenti
        public Map<Integer, String> studente = new TreeMap<>();

        public studenti(){}

        // Funzione che aggiunge uno studente
        public void aggiungiStudente(int matricola, String nome, String cognome) {
            this.studente.put(matricola, nome + ' ' + cognome);
        }
    }


    public static void main(String[] args) {
        try {
            // Il nostro file
            Scanner s = new Scanner(new FileReader("scuola.txt"));
            // Prendo l'header
            String scuola = s.nextLine().split(":")[1];
            String annoScolastico = s.nextLine().split(":")[1];
            String dirigente = s.nextLine().split(":")[1];
            String base = scuola + "\nAnno scolastico " + annoScolastico + "\nClasse ";

            // Salto tutte le righe fino alla riga con tutte ------
            while(!s.nextLine().endsWith("-")) {
            }
            // Conterrà le nostre linee
            String[] linea;
            // Continuamo fino alla fine
            while(s.hasNext()) {
                // Leggiamo la riga
                linea = s.nextLine().split(" ");
                // Se non contiene la classe
                if (!classi.containsKey(linea[3]))
                    // Aggiungila
                    classi.put(linea[3], new studenti());
                // Aggiungi lo studente
                classi.get(linea[3]).aggiungiStudente(Integer.parseInt(linea[0]), linea[1], linea[2]);




            }
                int valore_partenza = 0,
                        valore_fine = 0,
                        bias = 0;
            float delta = (float) classi.keySet().size() / 4;
            ExecutorService executor = Executors.newCachedThreadPool();
            for(int i = 0; i < 4; i++) {
                // Se delta ha una parte decimale, allora aggiungi 1 al bias
                // Siccome utilizzeremo 4 thread, voglio che venga il tutto spartito in egual modo
                if ((delta - (int) delta) != 0) {
                    bias = 1;
                    delta -= 0.25;
                }
                // sommiamo
                valore_fine += (int) delta + bias;
                int partenza = valore_partenza, fine = valore_fine;
                // Avviamo il thread
                executor.execute( () -> stampa_valori(partenza, fine, base));


                // Prepariamoci per dopo
                bias = 0;
                valore_partenza = valore_fine;

            }

            executor.shutdown();
            System.out.println("fine");
        // File non trovato
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        }


    }

    public static void stampa_valori(int partenza, int fine, String base) {
        for(Object classe : Arrays.copyOfRange(classi.keySet().toArray(), partenza, fine)) {
            try {
                BufferedWriter bf = new BufferedWriter(new FileWriter(classe + ".txt"));
                bf.write(base + classe);
                for(int matricola : classi.get(classe).studente.keySet()) {
                    bf.write(String.format("\n%d %s",matricola, classi.get(classe).studente.get(matricola)));
                }
                bf.close();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }

}
