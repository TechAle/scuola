package com.company;


import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;
import java.nio.charset.StandardCharsets;

public class Server_Class {

    final static int portaServer = 4500;

    public static void main(String[] args) {

        try (ServerSocket server = new ServerSocket(portaServer)) {
            System.out.format("Server in ascolto su: %s%n",
                    server.getLocalSocketAddress());
            // Il server accetta e serve un client alla volta
            while (true) {
                try (Socket client = server.accept()) {
                    String rem = client.getRemoteSocketAddress().toString();
                    System.out.format("Client (remoto): %s%n", rem);
                    comunica(client);
                } catch (IOException e) {
                    System.err.println(String.format("Errore durante la comunicazione con il client: %s", e.getMessage()));
                }
            }
        } catch (IOException e) {
            System.err.println(String.format("Errore server: %s", e.getMessage()));
        }

    }
    private static void comunica(Socket sck) throws IOException {
        BufferedReader in = new BufferedReader(
                new InputStreamReader(sck.getInputStream(), StandardCharsets.UTF_8));
        PrintWriter out = new PrintWriter(
                new OutputStreamWriter(sck.getOutputStream(), StandardCharsets.UTF_8), true);
        System.out.println("In attesa di ricevere informazioni dal client...");
        String inStr = in.readLine();
        System.out.format("Ricevuto dal client: %s%n", inStr);
        String outStr = elabora(inStr);
        out.println(outStr);
        System.out.format("Inviato al client: %s%n", outStr);
    }
    private static String elabora(String s) {
        int val = Integer.parseInt(s);
        return val % 2 == 0 ? "pari": "dispari";
    }

}