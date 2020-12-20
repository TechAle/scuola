package com.company;

import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;
import java.nio.charset.StandardCharsets;

public class Main {
    // Porta dove lavora il server
    final static int portaServer = 4000;

    public static void main(String[] args) {
        // Proviamo ad aprire un server su porta 4000
        try (ServerSocket server = new ServerSocket(portaServer)) {
            // iniziano ad ascoltare
            System.out.format("Server in ascolto su: %s%n", server.getLocalSocketAddress());
            // Per sempre
            while (true) {
                // Accettiamo un cliente
                try (Socket client = server.accept()) {
                    String rem = client.getRemoteSocketAddress().toString();
                    System.out.format("Client (remoto): %s%n", rem);
                    // Iniziamo la comunicazione
                    comunica(client);
                // Se c'è stato un errore
                } catch (IOException e) {
                    System.err.printf("Errore durante la comunicazione con il client: %s%n", e.getMessage());
                }
            }
        // Errore apertura server
        } catch (IOException e) {
            System.err.printf("Errore server: %s%n", e.getMessage());
        }
    }

    private static void comunica(Socket sck) throws IOException {
        // lettore
        BufferedReader in = new BufferedReader(
                new InputStreamReader(sck.getInputStream(), StandardCharsets.UTF_8));
        // Scrittore
        PrintWriter out = new PrintWriter(
                new OutputStreamWriter(sck.getOutputStream(), StandardCharsets.UTF_8), true);
        // Ciò che riceviamo
        String inStr,
               outStr;
        System.out.println("In attesa di ricevere informazioni dal client...");
        // Ricezioni di N
        final int N = Integer.parseInt(in.readLine().trim());
        System.out.println("Ricevuto N, inizio elaborazione prodotti");
        // Ricezione di tutti i dati
        int nb = 0, n1, n2;
        var prodotti = new int[N];
        String input;
        for(int i = 0; i < N; i++) {
            input = in.readLine();
            n1 = Integer.parseInt(input.split(" ")[0]);
            n2 = Integer.parseInt(input.split(" ")[1]);
            if (n1 * n2 > 0) {
                prodotti[nb] = n1*n2;
                nb++;
            }
        }
        System.out.println("Invio nb e i vari prodotti");
        out.println(nb);
        for(int i = 0; i < nb; i++) {
            out.println(prodotti[i]);
        }
        System.out.println("Fine servizio");


    }


}
