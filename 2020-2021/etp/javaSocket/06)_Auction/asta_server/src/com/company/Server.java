package com.company;
import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;
import java.nio.charset.StandardCharsets;
import java.util.Scanner;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class Server {
    // Offerta massima
    static float offerta_max = 0;
    // Porta del nostro server
    static final int PORTA_SERVER = 9090;
    // Numero massimo di persone
    static final int MAX_THREAD = 5;
    // Il nostro pool di thread
    static ExecutorService esecutore = Executors.newFixedThreadPool(MAX_THREAD);
    // Il lock
    static final Object lock = new Object();
    public static void main(String[] args) {
        // Apriamo il server
        try (ServerSocket server = new ServerSocket(PORTA_SERVER)) {
            // Stampa che l'abbiamo aperto
            System.out.format("Server in ascolto su: %s%n", server.getLocalSocketAddress());
            // Accettiamo sempre i clienti
            while (true) {
                Socket tempSck;
                try {
                    // Accettiamo
                    tempSck = server.accept();
                    esecutore.execute(() -> {
                        // Copia
                        Socket client = tempSck;
                        try (client) {
                            // Stampa delle informazioni
                            String rem = client.getRemoteSocketAddress().toString();
                            Thread t = Thread.currentThread();
                            System.out.printf("Thread %d - Client (remoto): %s\n", t.getId(), rem);
                            // Inizio comunicazione
                            comunica(client);

                        } catch (IOException e) {
                            System.err.printf("Errore durante la comunicazione con il client: %s%n", e.getMessage());
                        }
                    });
                } catch (IOException e) {
                    System.err.printf("Errore nella gestione di nuove connessioni: %s%n", e.getMessage());
                }
            }
        } catch (IOException e) {
            System.err.printf("Errore del server: %s%n", e.getMessage());
        }
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
            Thread t = Thread.currentThread();
            // Variabile appoggio input
            String inStr;
            while(loop) {
                // Attendiamo informazioni del cliente
                System.out.println("In attesa di ricevere informazioni dal client...");
                inStr = in.readLine().trim();
                System.out.printf("Ricevuto dal client: %s\n", inStr);

                String risposta = elabora(inStr);

                // Se vuole uscire
                if (risposta.equals("uscita")) {
                    loop = false;
                    System.out.printf("Disconnessione dal thread %d\n", t.getId());
                // Senò
                } else {
                    // Invia le informazioni
                    System.out.printf("Thread %d - Inviato al client: %s\n", t.getId(), risposta);
                    out.println(risposta);
                    // Errore durante l'invio dei dati
                    if (out.checkError()) {
                        throw new IOException("Errore durante la scrittura dei dati.");
                    }
                }
            }

        } catch (UnsupportedEncodingException unsupportedEncodingException) {
            unsupportedEncodingException.printStackTrace();
        } catch (IOException ioException) {
            ioException.printStackTrace();
        }
        System.out.println("Disconnessione Eseguita con successo");
    }

    private static String elabora(String dati){
        // Analizziamo con lo scanner
        Scanner scanner = new Scanner(dati);
        // Prendiamo il primo carattere
        char c = scanner.next().charAt(0);
        // Il nostro output
        String str;

        // Se viene fatta una richiesta di nuova ooferta
        if( c == 'N'){
            float offerta = scanner.nextFloat();
            // Inizio area critica
            synchronized (lock) {
                // Se l'offerta è maggiore di quella che già abbiamo
                if (offerta > offerta_max) {
                    // Accettiamo
                    offerta_max = offerta;
                    str = String.format("Offerta di %.2f euro accettata", offerta);
                // Senò rifiutiamo
                } else {
                    str = String.format("Offerta di %.2f euro non accettata", offerta);
                }
            }
            // Fine area critica
        // Se ci chiede la massima offerta
        }
        else if( c =='M') {
            str = String.format("Migliore offerta: %.2f", offerta_max);
        }
        // Se vuole uscire
        else if ( c == 'X' ) {
            str = "uscita";
        }
        // Se non ci invia nulla
        else{
            str = "";
        }
        // Ritorniamo
        return str;
    }
}