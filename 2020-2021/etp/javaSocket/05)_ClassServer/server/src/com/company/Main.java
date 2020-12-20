package com.company;

import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;
import java.net.UnknownHostException;
import java.nio.charset.StandardCharsets;
import java.util.Scanner;

public class Main {

    // Ciò che inviero
    static class triangolo implements Serializable {
        public float v1x;
        public float v1y;
        public float v2x;
        public float v2y;
        public float v3x;
        public float v3y;
        public triangolo(float v1x, float v1y, float v2x, float v2y, float v3x, float v3y) {
            this.v1x = v1x;
            this.v1y = v1y;
            this.v2x = v2x;
            this.v2y = v2y;
            this.v3x = v3x;
            this.v3y = v3y;
        }
    }
    // Ciò che riceverò
    static class Risultato implements Serializable {
        public float area;
        public float perimetro;
        public Risultato(float area, float perimetro) {
            this.area = area;
            this.perimetro = perimetro;
        }
    }
        final static String nomeServer = "localhost";
        final static int portaServer = 5000;
        public static void main(String[] args) {
            System.out.println("Connessione al server in corso...");
            try (Socket sck = new Socket(nomeServer, portaServer)) {
                String rem = sck.getRemoteSocketAddress().toString();
                String loc = sck.getLocalSocketAddress().toString();
                System.out.format("Server (remoto): %s%n", rem);
                System.out.format("Client (client): %s%n", loc);
                comunica(sck);
            } catch (UnknownHostException e) {
                System.err.format("Nome di server non valido: %s%n", e.getMessage());
            } catch (IOException e) {
                System.err.format("Errore durante la comunicazione con il server: %s%n",
                        e.getMessage());
            }
        }
        private static void comunica(Socket sck) throws IOException {
            // Scrittore
            ObjectOutputStream out = new ObjectOutputStream(sck.getOutputStream());
            // Lettore
            ObjectInputStream in = new ObjectInputStream(sck.getInputStream());
            Scanner s = new Scanner(System.in);
            System.out.println("Inserire x y del primo lato:");
            float vx1 = s.nextFloat();
            float vy1 = s.nextFloat();

            System.out.println("Inserire x y del secondo lato:");
            float vx2 = s.nextFloat();
            float vy2 = s.nextFloat();

            System.out.println("Inserire x y del primo lato:");
            float vx3 = s.nextFloat();
            float vy3 = s.nextFloat();

            triangolo ric = new triangolo(vx1, vy1, vx2, vy2, vx3, vy3);
            out.writeObject(ric);
            System.out.println("In attesa di risposta dal server...");
            Risultato ris = null;
            try {
                // Deserializzazione: ricevo una sequenza di byte e
                // la trasformo in un oggetto
                ris = (Risultato) in.readObject();
            } catch (ClassNotFoundException e) {
                throw new IOException("Tipo di risultato non supportato.");
            }
            System.out.println("Risultato:\nPerimetro: " + ris.perimetro + "\nArea: " + ris.area );

        }


}
