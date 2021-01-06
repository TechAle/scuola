/*
 * Autore: Condello Alessandro
 * Nome progetto:condello-traduttore-singolo
 * Nome file: serverUdp.java
 * Descrizione: Creare un server che permetta la comunicazione di più client che vogliono tradurre delle frasi
 * Portato e Modificato dall'esercizio n^4.2 "Server Multicast"
 */
package com.company;

import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.net.DatagramPacket;
import java.net.InetAddress;
import java.net.MulticastSocket;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.Scanner;

public class serverUdpIso {
    final static String gruppo = "239.255.2.9";
    final static int portaMulticast = 92;
    final static int ritardo = 100; // ms
    final static ArrayList<String> isoList = new ArrayList<>();
    static final Charset format = StandardCharsets.UTF_8;


    public static void main(String[] args) {
        byte[] bufferOut;
        int indice = 0;
        // Leggiamo la nostra lista
        try (Scanner s = new Scanner(new FileReader("../dataset.txt"))) {
            while(s.hasNext()) {
                String p = s.nextLine();
                isoList.add(p);
            }
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        }

        // Avviamo il multicast
        try (MulticastSocket sck = new MulticastSocket()) {
            System.out.println("Server avviato.");
            InetAddress ipMulticast = InetAddress.getByName(gruppo);
            while (true) {
                // Ritardo
                Thread.sleep(ritardo);
                // Prendiamo la frase
                String af = isoList.get(indice) + System.lineSeparator();
                // Trasformiamola in datagrammi
                bufferOut = af.getBytes(format);
                DatagramPacket pktOut = new DatagramPacket(bufferOut, bufferOut.length,
                        ipMulticast, portaMulticast);
                // Inviamola
                sck.send(pktOut);
                // Output
                System.out.format("Inviato codice %d all'indirizzo di multicast %s con frase %s%n",
                        indice, ipMulticast, isoList.get(indice));
                // Torniamo indietro
                indice = (indice + 1) % isoList.size();
            }
        } catch (IOException | InterruptedException e) {
            e.printStackTrace();
        }
    }
}