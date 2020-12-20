package com.company;
import java.io.*;
import java.net.Socket;
import java.net.UnknownHostException;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.Scanner;

public class Client {
    // Dove ci vogliamo connettere
    final static String nomeServer = "localhost";
    // La porta
    final static int portaServer = 9090;
    // Lista di valori
    static ArrayList<Integer> lista_val = new ArrayList<>();

    public static void main(String[] args) {
        // Cerchiamo di connetterci
        System.out.println("Connessione al server in corso...");
        try (Socket sck = new Socket(nomeServer, portaServer)) {
            // Informazioni del cliente / server
            String rem = sck.getRemoteSocketAddress().toString();
            String loc = sck.getLocalSocketAddress().toString();
            System.out.printf("Server: %s\n", rem);
            System.out.printf("Client: %s\n", loc);
            // Iniziamo la comunicazione
            comunica(sck);
        // Nome del server non valido
        } catch (UnknownHostException e) {
            System.err.format("Nome di server non valido: %s%n", e.getMessage());
        } catch (IOException e) {
        // Errore durante la comunicazione del server
            System.err.format("Errore durante la comunicazione con il server: %s%n", e.getMessage());
        }
    }

    private static void comunica(Socket sck) throws IOException {
        try (BufferedReader in = new BufferedReader(
             new InputStreamReader(sck.getInputStream(), StandardCharsets.UTF_8));
             PrintWriter out = new PrintWriter(
             new OutputStreamWriter(sck.getOutputStream(), StandardCharsets.UTF_8), true)) {

            /// Nome
            // Richiedo il nome per poi inviarlo
            String nome;
            do {
                Scanner s = new Scanner(System.in);

                System.out.print("Nome: ");
                nome = s.nextLine();

            }while(nome.equals(""));
            // Invio del nome
            System.out.println("Invio del nome " + nome);
            out.println(nome);

            /// Numeri
            String output;
            boolean uscita = true;
            int numero_aggiunto;
            do {
                Scanner s = new Scanner(System.in);

                System.out.print("Inserire i numeri che vuoi inviare. Inviare una X se  ");
                output = s.nextLine();

                out.println(output);

                // Riceviamo l'output
                do {
                    output = in.readLine().trim();
                    if (!output.isEmpty()) {
                        // Iteriamo
                        Scanner out_s = new Scanner(output);
                        while (out_s.hasNext()) {
                            String parte = out_s.next().trim();
                            switch (parte) {
                                case "0":
                                    numero_aggiunto = Integer.parseInt(out_s.next().trim());
                                    System.out.printf("Numero %s è stato rifiutato\n", numero_aggiunto);
                                    break;
                                case "1":
                                    numero_aggiunto = Integer.parseInt(out_s.next().trim());
                                    System.out.printf("Numero %s accettato\n", numero_aggiunto);
                                    lista_val.add(numero_aggiunto);
                                    break;
                                case "2":
                                    numero_aggiunto = Integer.parseInt(out_s.next().trim());
                                    System.out.printf("Numero %s è stato rifiutato siccome supera il limite di 100\n", numero_aggiunto);
                                    break;
                                case "x":
                                    System.out.println("Uscita in corso");
                                    uscita = false;
                                    break;
                                case "m":
                                    System.out.println("Uscita in corso, numero massimo raggiunto");
                                    uscita = false;
                                    break;
                            }
                        }
                    }else break;
                }while(true);
            }while(uscita);

            System.out.println("In attesa che la lotteria inizi..");

        }
    }
}