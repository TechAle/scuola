package com.company;
import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.Scanner;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.CountDownLatch;

public class Server {

    // Porta del nostro server
    static final int PORTA_SERVER = 9090;
    // Numero massimo di persone
    static final int MAX_THREAD = 10;
    // Numero minimo di persone prima di iniziare
    static final int MIN_THREAD = 2;
    // Numero massimo di numeri
    static final int MAX_N = 5;
    // Numero massimo che un numero può avere
    static final int MAX_LEN = 100;
    static ArrayList<Integer> numeri = new ArrayList<Integer>();
    // Il nostro pool di thread
    static ExecutorService esecutore = Executors.newFixedThreadPool(MAX_THREAD);
    // Il nostro locker
    static final Object lock = new Object();
    // Il nostro semaforo
    static CountDownLatch semaforo = new CountDownLatch(MIN_THREAD);

    public static void main(String[] args) {
        // Apriamo il server
        try (ServerSocket server = new ServerSocket(PORTA_SERVER)) {
            // Stampa che l'abbiamo aperto
            System.out.format("Server in ascolto su: %s%n", server.getLocalSocketAddress());
            // Accettiamo sempre i clienti
            while (true) {
                Socket tempSck;
                try {
                    // Accettiamo ogni cliente
                    tempSck = server.accept();
                    esecutore.execute(() -> {
                        // Copia siccome così il server potrà subito ricevere altri messaggi
                        Socket client = tempSck;
                        try (client) {
                            // Stampa delle informazioni
                            String rem = client.getRemoteSocketAddress().toString();
                            // Prendo l'id del thread
                            long t = Thread.currentThread().getId();
                            System.out.printf("Thread %d - Client (remoto): %s\n", t, rem);
                            // Inizio comunicazione
                            comunica(client);
                        // Errore con il cliente
                        } catch (IOException e) {
                            System.err.printf("Errore durante la comunicazione con il client: %s%n", e.getMessage());
                        }
                    });
                // Errore durante l'accettazione
                } catch (IOException e) {
                    System.err.printf("Errore nella gestione di nuove connessioni: %s%n", e.getMessage());
                }
            }
        // Errore apertura del server
        } catch (IOException e) {
            System.err.printf("Errore del server: %s%n", e.getMessage());
        }
    }

    public static boolean isNumeric(String str) {
        return str.matches("-?\\d+(\\.\\d+)?");  //match a number with optional '-' and decimal.
    }

    private static void comunica(Socket sck) {
        try (
                // Input (testuale)
                BufferedReader in = new BufferedReader (new InputStreamReader(sck.getInputStream(), StandardCharsets.UTF_8));
                // Output
                PrintWriter out = new PrintWriter(new OutputStreamWriter(sck.getOutputStream(), StandardCharsets.UTF_8), true))
        {
            /// Informazioni generali che serviranno
            // Per l'uscita dal loop
            boolean loop = true;
            // Nome thread
            long t = Thread.currentThread().getId();

            /// Nome
            String nome;
            // Attendiamo informazioni del cliente
            System.out.printf("In attesa di ricevere il nome dal thread %d\n", t);
            do {
                // Leggiamo ciò che ci invia
                nome = in.readLine().trim();
                if (!nome.equals("")) {
                    break;
                } else {
                    System.out.printf("Ricevuta una stringa vuota del cliente %d\n", t);
                }
            }while(true);
            System.out.printf("Nome del client del thread %d: %s\n",t ,nome);

            /// Ricezione dei numeri
            ArrayList<Integer> numeri_scelti = new ArrayList<>();
            boolean fine = true;
            do {
                // Leggiamo la linea
                String linea = in.readLine();
                // Mettiamola denteo a uno scanner
                Scanner s = new Scanner(linea);
                // Fino a che ha spazio
                while (s.hasNext()) {
                    // Leggiamo fino allo spazio
                    String parte = s.next().trim();
                    // Se è vuota, allora finisci
                    if (parte.equals("")) {
                        fine = false;
                        // Dico al cliente che la sua richiesta di fine è stata accettata
                        out.println("x");
                        break;
                    }
                    // Controlla se è un numero
                    if (isNumeric(parte)) {
                        // Trasformo il numero in un intero
                        int val = Integer.parseInt(parte);
                        // Accesso con mutua esclusione
                        synchronized (lock) {
                            // Controllo che sia disponibile
                            if (!numeri.contains(val)) {
                                if (val < MAX_LEN) {
                                    System.out.printf("Cliente %s ha aggiunto il numero %d\n", t, val);
                                    // Aggiungo il numero alle liste
                                    numeri_scelti.add(val);
                                    numeri.add(val);
                                    // Dico al cliente che abbiamo aggiunto il numero
                                    out.println(String.format("1 %d", val));
                                }else {
                                    System.out.printf("Cliente %s ha aggiunto il numero %d, che và oltre al massimo\n", t, val);
                                    out.println(String.format("2 %d", val));
                                }
                            }else {
                                System.out.printf("Cliente %s ha aggiunto un numero che già esiste: %d\n", t, val);
                                out.println(String.format("0 %d", val));
                            }
                        }
                        // Controllo se abbiamo superato il limite
                        if (numeri.size() == MAX_N) {
                            System.out.printf("Cliente %d ha raggiunto il numero massimo di numeri\n", t);
                            fine = false;
                            // Dico al cliente che ha raggiunto il limite
                            out.println(String.format("m %d", MAX_N));
                            break;
                        }

                    }
                }
                out.println("");
            }while(fine);




        } catch (UnsupportedEncodingException unsupportedEncodingException) {
            unsupportedEncodingException.printStackTrace();
        } catch (IOException ioException) {
            ioException.printStackTrace();
        }
        System.out.println("Disconnessione Eseguita con successo");
    }

}