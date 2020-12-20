package com.company;

import java.io.*;
import java.net.Socket;
import java.net.UnknownHostException;
import java.nio.charset.StandardCharsets;
import java.util.Random;

public class Main {

    // Dove ci vogliamo connettere
    final static String nomeServer = "localhost";
    // La porta con cui ci vogliamo connettere
    final static int portaServer = 4000;
    /// Costanti per generare le coppie
    // numero
    final static int N = 5;
    // Massimo && Minimo
    final static int max = 150,
            min = 0;
    // Random
    static Random rand = new Random(2020);

    public static void main(String[] args) {
        System.out.println("Connessione al server in corso...");
        // Connettiamoci al server
        try (Socket sck = new Socket(nomeServer, portaServer)) {
            // prendiamo il socket del server
            String rem = sck.getRemoteSocketAddress().toString();
            // Prendiamo il socket dell'host
            String loc = sck.getLocalSocketAddress().toString();
            // Li stampiamo
            System.out.format("Server (remoto): %s%n", rem);
            System.out.format("Client (client): %s%n", loc);
            // Iniziamo la comunicazione
            comunica(sck);
            // Se il server non è valido
        } catch (UnknownHostException e) {
            System.err.format("Nome di server non valido: %s%n", e.getMessage());
            // Se c'è stato un errore nella comunicazione
        } catch (IOException e) {
            System.err.format("Errore durante la comunicazione con il server: %s%n",
                    e.getMessage());
        }
    }

    private static void comunica(Socket sck) throws IOException {
        // Lettore
        BufferedReader in = new BufferedReader(
                new InputStreamReader(sck.getInputStream(), StandardCharsets.UTF_8));
        // Scrittore
        PrintWriter out = new PrintWriter(
                new OutputStreamWriter(sck.getOutputStream(), StandardCharsets.UTF_8), true);
        // Ciò che invieremo
        String parola;


        // Stampa iniziale
        System.out.print("Coordinate (x y): ");
        // Iteriamo
        for(int i = 0; i < N; i++) {
            parola = genera_input();
            // Inviamo
            System.out.format("%s\t", parola);
            out.println(parola);
            // Aspettiamo la sua risposta
            parola = in.readLine();
            System.out.println(parola);
        }
        out.println(""); // Invio di una linea vuota per dire che ho finito
    }

    private static String genera_input() {
        return Integer.toString(rand.nextInt(max - min) + min) + ' ' + Integer.toString(rand.nextInt(max - min) + min);
    }
}
