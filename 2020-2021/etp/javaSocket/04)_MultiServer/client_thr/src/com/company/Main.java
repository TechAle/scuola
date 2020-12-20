package com.company;

import java.io.*;
import java.net.*;
import java.nio.charset.StandardCharsets;
import java.util.Scanner;

public class Main {

    final static String nomeServer = "localhost";
    final static int portaServer = 5000;
    final static int MIN_N = 0;
    final static int MAX_N = 100;
    final static int MIN_INTERVALLO = 0;
    final static int MAX_INTERVALLO = 1000000;
    public static void main(String[] args) {
        System.out.println("Connessione al server in corso...");
        try (Socket sck = new Socket(nomeServer, portaServer)) {
            String rem = sck.getRemoteSocketAddress().toString();
            String loc = sck.getLocalSocketAddress().toString();
            System.out.format("Server: %s%n", rem);
            System.out.format("Client: %s%n", loc);
            comunica(sck);
        } catch (UnknownHostException e) {
            System.err.format("Nome di server non valido: %s%n", e.getMessage());
        } catch (IOException e) {
            System.err.format("Errore durante la comunicazione con il server: %s%n",
                    e.getMessage());
        }
    }
    private static void comunica(Socket sck) throws IOException {
        try (
                BufferedReader in = new BufferedReader(
                        new InputStreamReader(sck.getInputStream(), StandardCharsets.UTF_8));
                PrintWriter out = new PrintWriter(
                        new OutputStreamWriter(sck.getOutputStream(), StandardCharsets.UTF_8), true);
                Scanner s = new Scanner(System.in, StandardCharsets.UTF_8);
        ) {
            String valori;
            int count = 0;
            do {
                System.out.print("Valore da inviare: ");
                valori = s.nextLine();
                if (!valori.isEmpty()) {
                    count++;
                    System.out.printf("Invio della stringa n^%d: %s\n", count, valori);
                    out.println(valori);
                }else{ out.println();break;}
            }
            while (true);
            System.out.println("Attesa risposta...");
            for(int i = 0; i < count; i++) {
                String risposta = in.readLine();
                System.out.print(risposta + '\n');
            }
        }
    }
}
