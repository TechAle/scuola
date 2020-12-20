package com.company;

import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;
import java.nio.charset.StandardCharsets;

public class Main {
    // Porta dove lavora il server
    final static int portaServer = 4000;
    // Definisco distanza
    final static int distanza = 100;

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
        do {
            // Leggiamo
            inStr = in.readLine().trim();
            if (!inStr.isEmpty()) {
                // Scriviamo
                System.out.format("Ricevuto dal client: %s: ", inStr);
                // Vediamo se sono vicini o no
                outStr = vicinanza(inStr);
                System.out.println(outStr);
                out.println(outStr);
            }
        }
        // Terminiamo quando riceviamo una stringa vuota
        while (!inStr.isEmpty());
        System.out.println("Fine");
        /// Ricordati che si invia così
        //out.println("arrivederci");
    }
    private static String vicinanza(String input) {
        int val1 = Integer.parseInt(input.split(" ")[0]);
        int val2 = Integer.parseInt(input.split(" ")[0]);
        // Ritorno
        return (Math.sqrt(Math.pow(val1, 2) + Math.pow(val1, 2))) >= distanza ? "lontani" : "vicini";
    }

}
