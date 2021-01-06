/*
 * Autore: Condello Alessandro
 * Nome progetto:condello-traduttore-singolo
 * Portato e Modificato dall'esercizio n^3.1 "Server MultiThread"
 * Nome file: serverTcp.java
 * Descrizione del progetto: Creare un server che permetta la comunicazione di più client che vogliono tradurre delle frasi
 * Descrizione del file: Creare un programma che sia capace di gestire una connessione tcp per la traduzioni delle frasi
 */
package com.company;

import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.util.*;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class serverTcp {

    // Porta tcp
    static final int PORTA_SERVER = 91;
    // N^ Max persone
    static final int MAX_THREAD = 4;
    // Il nostro formato
    static final Charset format = StandardCharsets.UTF_8;
    // La nostra lista iso
    static ArrayList<String> isoList = new ArrayList<>();
    // La nostra lista con la traduzione
    static HashMap<String, String> isoListForm = new HashMap<>();
    // Contenitore delle nostra traduzione
    static List<HashMap<String, String>> traduttoreLista = new ArrayList<HashMap<String, String>>();

    // Esecutore di task. Utilizza un pool di MAX_THREAD thread
    static ExecutorService esecutore = Executors.newFixedThreadPool(MAX_THREAD);
    public static void main(String[] args) {
        // Leggi il nostro file / udp
        readFile();
        // Crea iso
        createFormatted();
        // Crea traduzione
        createTraduttore();
        // Avvia il server
        avvioServer();
    }

    public static void avvioServer() {
        try (ServerSocket server = new ServerSocket(PORTA_SERVER)) {
            System.out.format("Server in ascolto su: %s%n", server.getLocalSocketAddress());
            while (true) {
                Socket tempSck;
                try {
                    tempSck = server.accept();
                    esecutore.execute(() -> {
                        // Copia il socket creato dal main thread: in questo modo la variabile
                        // tmpSck può essere utilizzata per accettare nuove connessioni.
                        Socket client = tempSck;
                        try (client) {
                            String rem = client.getRemoteSocketAddress().toString();
                            Thread t = Thread.currentThread();
                            System.out.format("Thread %d - Client (remoto): %s%n", t.getId(), rem);
                            // Avvia la comunicazione con il client. Il socket è automaticamente
                            // chiuso alla fine di questo blocco TRY/CATCH
                            comunica(client);
                        } catch (IOException e) {
                            System.err.println(String.format("Errore durante la comunicazione con il client: %s", e.getMessage()));
                        }
                    });
                } catch (IOException e) {
                    System.err.println(String.format("Errore nella gestione di nuove connessioni: %s", e.getMessage()));
                }
            }
        } catch (IOException e) {
            System.err.println(String.format("Errore del server: %s", e.getMessage()));
        }
    }

    public static void readFile() {
        // Leggiamo il nostro file
        try (Scanner s = new Scanner(new FileReader("../dataset.txt"))) {
            // Fino a che possiamo
            while(s.hasNext()) {
                // Leggiamo
                String p = s.nextLine();
                isoList.add(p);
            }
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        }
    }

    public static void createTraduttore() {
        // Leggiamo il nostro file
        try (Scanner s = new Scanner(new FileReader("../datasetDizionario.csv"))) {
            // Prendiamo i valori della prima riga
            ArrayList<String> traduzioniDisponibili = new ArrayList<>(Arrays.asList(s.nextLine().toLowerCase().strip().split(",")));
            // Inizio a creare il nostro traduttore
            int i = 0;
            while(s.hasNext()) {
                String p = s.nextLine().toLowerCase().strip();
                // Itero per tutte le traduzioni
                traduttoreLista.add(new HashMap<>());
                int j = 0;
                // Divido per la virgola
                for(String parte : p.split(",")) {
                    traduttoreLista.get(i).put(traduzioniDisponibili.get(j++), parte);
                }
                i++;
            }
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        }
    }

    public static void createFormatted() {
        // Creiamo array
        String[] temp;
        // Iteriamo
        for(String parte : isoList) {
            // Splittiamo per =
            temp = parte.toLowerCase().split("=");
            // Se contiene ,
            if (temp[1].contains(",")) {
                // Allora vuol dire che ci sono più paesi
                for(String paese : temp[1].split(","))
                    // Aggiungi per ognuno
                    isoListForm.put(paese.strip(), temp[0].strip());
                // Aggiungi
            }else isoListForm.put(temp[1].strip(), temp[0].strip());
        }
    }

    private static void comunica(Socket sck) {
        try (
                BufferedReader in = new BufferedReader(
                        new InputStreamReader(sck.getInputStream(), format));
                PrintWriter out = new PrintWriter(
                        new OutputStreamWriter(sck.getOutputStream(), format), true);
        ) {
            // Varie variabili
            Thread t = Thread.currentThread();
            String input, linguaRicevuta, testo, linguaRichiesta;
            String[] temp;

            do {
                // Leggiamo la richiesta
                input = in.readLine();
                // Se vuole uscire
                if (input.equals("x")) {
                    break;
                }else {
                    // Dividiamo
                    temp = input.split("/");
                    linguaRicevuta = temp[0];
                    testo = temp[1];
                    linguaRichiesta = temp[2];

                    System.out.printf("Thread %d ha inviato %s%n", t.getId(), input);

                    // Controlliamo che esistono
                    if (isoListForm.containsValue(linguaRicevuta) && isoListForm.containsValue(linguaRichiesta)) {
                        // Controlliamo che possediamo ambe due li abbiamo
                        if(traduttoreLista.get(0).containsKey(linguaRicevuta) && traduttoreLista.get(0).containsKey(linguaRichiesta)) {
                            // Cerchiamo se abbiamo la traduzione
                            int trovato = -1;
                            int i = 0;
                            // Iteriamo
                            for(HashMap<String, String> traduzioneSingola : traduttoreLista) {
                                // Controlliamo se c'è
                                if (traduzioneSingola.get(linguaRicevuta).equals(testo)) {
                                    // Si
                                    trovato = i;
                                    break;
                                }
                                i++;
                            }
                            // Se è stato trovato
                            if (trovato != -1) {
                                // Invia la traduzione
                                out.println(traduttoreLista.get(i).get(linguaRichiesta));
                            }else out.println("2");

                        }else out.println("1");
                    }else out.println("0");
                }

            }while (true);

            System.out.printf("Utente nel thread %d è uscito%n", t.getId());


        } catch (UnsupportedEncodingException e) {
            System.err.println(String.format("Codifica di caratteri non supportata: %s",
                    e.getMessage()));
        } catch (IOException e) {
            System.err.println(String.format("Errore di I/O: %s", e.getMessage()));
        }
    }
    
}
