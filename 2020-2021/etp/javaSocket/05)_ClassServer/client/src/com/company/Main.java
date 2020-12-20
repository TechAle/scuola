package com.company;

import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;

public class Main {

    // Ciò che riceverà
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
    static class Risultato implements Serializable {
        public float area;
        public float perimetro;
        public Risultato(float area, float perimetro) {
            this.area = area;
            this.perimetro = perimetro;
        }
    }
    final static int portaServer = 5000;
    public static void main(String[] args) {
        // Avvio il server
        try (ServerSocket server = new ServerSocket(portaServer)) {
            System.out.format("Server in ascolto su: %s%n",
                    server.getLocalSocketAddress());
            // Il server accetta e serve un client alla volta
            while (true) {
                // Accetto il client
                try (Socket client = server.accept()) {
                    // Prendo informazioni
                    String rem = client.getRemoteSocketAddress().toString();
                    System.out.format("Client (remoto): %s%n", rem);
                    // Inizio comunicazione
                    comunica(client);
                // Errore comunicazione
                } catch (IOException e) {
                    System.err.printf("Errore durante la comunicazione con il client: %s%n", e.getMessage());
                }
            }
        // Errore creazione server
        } catch (IOException e) {
            System.err.printf("Errore server: %s%n", e.getMessage());
        }
    }
    // Funzione per la comunicazione
    private static void comunica(Socket sck) throws IOException {
        // Lettura
        ObjectInputStream in = new ObjectInputStream(sck.getInputStream());
        // Scrittura
        ObjectOutputStream out = new ObjectOutputStream(sck.getOutputStream());
        // Attesa ricezione
        System.out.println("In attesa di ricevere informazioni dal client...");
        // Inizializzo a null
        triangolo ric = null;
        try {
            // Dobbiamo fare un cast
            ric = (triangolo) in.readObject();
        } catch (ClassNotFoundException e) {
            throw new IOException("Tipo di ricerca non supportata.");
        }
        System.out.println("Ricevuta dal client un triangolo");
        Risultato ris = elabora(ric);
        out.writeObject(ris);
        System.out.println("Inviato al client l'area e perimetro");
    }
    private static Risultato elabora(triangolo r) {
        float lato1 = distanza(r.v1x, r.v2x, r.v1y, r.v2y);
        float lato2 = distanza(r.v2x, r.v3x, r.v2y, r.v3y);
        float lato3 = distanza(r.v3x, r.v1x, r.v3y, r.v1y);
        System.out.format("%f %f %f", lato1, lato2, lato3);
        float perimetro = lato1 + lato2 + lato3;
        return new Risultato(eurone(lato1, lato2, lato3, perimetro / 2), perimetro);
    }

    public static float distanza(float x1, float x2, float y1, float y2) {
        return (float) Math.sqrt(Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2));
    }

   public static float eurone(float lato1, float lato2, float lato3, float perimetro) {
        return (float) Math.sqrt(perimetro * (perimetro - lato1) * (perimetro - lato2) * (perimetro - lato3));
   }

}
