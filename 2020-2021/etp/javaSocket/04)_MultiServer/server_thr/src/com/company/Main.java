package com.company;

import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.Random;
import java.util.Scanner;
import java.util.concurrent.*;
import java.util.concurrent.locks.*;

public class Main {
    static final int PORTA_SERVER = 5000;
    static final int MAX_THREAD = 4;
    static final int RITARDO = 2000; // ms
    // Esecutore di task. Utilizza un pool di MAX_THREAD thread
    static ExecutorService esecutore = Executors.newFixedThreadPool(MAX_THREAD);
    // Risorse condivise tra i thread di elaborazione
    static Random rnd = new Random(2019); // Generatore di numeri casuali
    static Lock lc = new ReentrantLock(); // Usato nell'accesso alle risorse in mutua esclusione
    public static void main(String[] args) {
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
                BufferedReader in = new BufferedReader(
                        new InputStreamReader(sck.getInputStream(), StandardCharsets.UTF_8));
                PrintWriter out = new PrintWriter(
                        new OutputStreamWriter(sck.getOutputStream(), StandardCharsets.UTF_8), true);
        ) {
            int n = 0;
            var outputs = new ArrayList<String>();
            Thread t = Thread.currentThread();
            String str;
            do {
                str = in.readLine();
                if (!str.isEmpty()) {
                    outputs.add(str);
                    n++;
                }else break;
            }while(true);

            for(int i = 0; i < n; i++) {
                char tipo = outputs.get(i).charAt(0);
                double perimetro;
                int RITARDO;
                String inputs;
                if (tipo == 'R') {
                    float val1 = Float.parseFloat(outputs.get(i).split(" ")[1]);
                    float val2 = Float.parseFloat(outputs.get(i).split(" ")[2]);
                    inputs = String.format("%.2f %.2f", val1, val2);
                    perimetro = (val1 + val2) * 2;
                    RITARDO = 2000;
                }else if (tipo == 'Q') {
                    float val1 = Float.parseFloat(outputs.get(i).split(" ")[1]);
                    inputs = String.format("%.2f", val1);
                    perimetro = val1 * 4;
                    RITARDO = 1000;
                }else {
                    float val1 = Float.parseFloat(outputs.get(i).split(" ")[1]);
                    float val2 = Float.parseFloat(outputs.get(i).split(" ")[2]);
                    inputs = String.format("%.2f %.2f", val1, val2);
                    perimetro = val1 + val2 + Math.sqrt(Math.pow(val1, 2) + Math.pow(val2, 2));
                    RITARDO = 4000;
                }
                Thread.sleep(RITARDO);
                System.out.format("Thread %d - Invio %d valore\n", t.getId(), i);
                out.printf("%c %s %.2f", tipo,inputs, perimetro);
                // La classe PrintWriter non genera eccezioni. In presenza di un errore
                // di comunicazione occorre lanciare esplicitamente un'eccezione.
                if (out.checkError()) {
                    throw new IOException("Errore durante la scrittura dei dati.");
                }
            }
        } catch (UnsupportedEncodingException e) {
            System.err.printf("Codifica di caratteri non supportata: %s%n",
                    e.getMessage());
        } catch (IOException e) {System.err.printf("Errore di I/O: %s%n", e.getMessage());
        } catch (InterruptedException e) { // Richiesto da Thread.sleep
            System.err.println(e.getMessage());
        }
    }
}
