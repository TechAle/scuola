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
    // minimo && max N
    final static int min_n = 20,
                     max_n = 40;
    // Range numeri
    final static int min_gen = -100,
                     max_gen = 100;
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

        // Genero N e lo invio
        final int N = rand.nextInt(max_n - min_n) + min_n;
        out.println(N);
        System.out.println("Inviato N " + N);

        // Itero per N
        int n1, n2;
        for(int i = 0; i < N; i++) {
            n1 = rand.nextInt(max_gen - min_gen) + min_gen;
            n2 = rand.nextInt(max_gen - min_gen) + min_gen;
            // invio
            out.printf(String.format("%s %s%n", n1, n2));
        }
        System.out.println("Inviati tutti i prodotti");
        // Attesa ricezione di quanti prodotti positivi
        int n_prodotti = Integer.parseInt(in.readLine().trim());
        System.out.println("Numero prodotti positivi: " + n_prodotti);
        for (int i = 0; i < n_prodotti; i++) {
            System.out.printf("prodotto %d: %s%n", i, in.readLine().trim());
        }

    }

}
