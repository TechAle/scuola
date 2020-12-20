package com.company;
import java.io.*;
import java.net.Socket;
import java.net.UnknownHostException;
import java.nio.charset.StandardCharsets;
import java.util.Scanner;

public class Client {
    // Dove ci vogliamo connettere
    final static String nomeServer = "localhost";
    // La porta
    final static int portaServer = 9090;
    // Il nostro budget
    final static float budget = 5000;

    public static void main(String[] args) {
        // Cerchiamo di connetterci
        System.out.println("Connessione al server in corso...");
        try (Socket sck = new Socket(nomeServer, portaServer)) {
            // Informazioni del cliente / server
            String rem = sck.getRemoteSocketAddress().toString();
            String loc = sck.getLocalSocketAddress().toString();
            System.out.printf("Server: %s\n", rem);
            System.out.printf("Client: %s\n", loc);
            comunica(sck);
        } catch (UnknownHostException e) {
            System.err.format("Nome di server non valido: %s%n", e.getMessage());
        } catch (IOException e) {
            System.err.format("Errore durante la comunicazione con il server: %s%n", e.getMessage());
        }
    }

    private static void comunica(Socket sck) throws IOException {
        try (BufferedReader in = new BufferedReader(
             new InputStreamReader(sck.getInputStream(), StandardCharsets.UTF_8));
             PrintWriter out = new PrintWriter(new OutputStreamWriter(sck.getOutputStream(), StandardCharsets.UTF_8), true);
             Scanner s = new Scanner(System.in, StandardCharsets.UTF_8))
        {
            /// Informazioni che ci serviranno
            // Entrata nel loop
            boolean loop = false;
            // Variabile per prendere l'offerta del cliente
            float offerta;
            // Ciò che inserirà
            char codice;
            // Variabile appoggio
            String str;

            System.out.print("Benvenuto nell'asta\n");

            do {


                System.out.printf("Budget disponibile: %.2f euro\n", budget);
                System.out.print("Le sue opzioni disponibili:\n" +
                                  "N : nuova offerta\n" +
                                  "M : Ricevere l'offerta massima\n" +
                                  "X : uscire\n" +
                                  "Decisione:  ");

                // Prendiamo la sua decisione
                codice = s.next().charAt(0);

                // Se vuole fare una nuova offerta
                if (codice == 'N') {
                    // Facciamoli inserire
                    do{
                        // Richiesta
                        System.out.print("Inserire valore offerta: ");
                        offerta = s.nextFloat();
                    // Esci se l'offerta è maggiore di zero e rientra nel nostro budget
                    }while( !(offerta < budget || offerta > 0) );
                    // Stringa che portiamo in output
                    str = String.format("N %f", offerta);

                    // Invio stringa
                    System.out.println("Invio dei dati");
                    out.println(str);

                    // Riceviamo risultato
                    System.out.println("Ricevimento risultati");
                    str = in.readLine();
                    System.out.println(str);


                }
                // Richiesta asta maggiore
                else if (codice == 'M') {
                    // Invio richiesta
                    System.out.println("Invio richiesta migliore offerta");
                    out.println("M");
                    // Ricevo risultati
                    System.out.println("Ricevimento risultati...");
                    // Leggo
                    str = in.readLine();
                    // Stampo
                    System.out.println(str);


                }
                // Richiesta di uscita
                else if (codice == 'X') {
                    loop = true;
                    out.println("X");
                }

            } while (!loop);
        }
    }
}