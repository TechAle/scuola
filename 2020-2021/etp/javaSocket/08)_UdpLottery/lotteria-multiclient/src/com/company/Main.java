package com.company;

import java.io.IOException;
import java.net.DatagramPacket;
import java.net.InetAddress;
import java.net.MulticastSocket;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.Random;

public class Main {

    final static String gruppo = "225.6.7.8";
    final static int portaMulticast = 6789;
    final static int maxNumeri = 5;
    final static String[] frasi = {"primo numero!", "ambo", "terna", "quartina", "cinquina, tombola!"};
    static ArrayList<Integer> numeri = new ArrayList<>();
    static Random r = new Random();
    public static void main(String[] args) {
        try (MulticastSocket sck = new MulticastSocket(portaMulticast)) {
            System.out.println("Client avviato.");
            InetAddress ipMulticast = InetAddress.getByName(gruppo);
            sck.joinGroup(ipMulticast);
            // Genero i numeri
            System.out.print("I tuoi numeri: ");
            int val;
            for(int i = 0; i < maxNumeri; i++) {
                do{
                    val = r.nextInt(99);
                }while (numeri.contains(val));
                numeri.add(val);
                System.out.print(val + " ");
            }
            int count = 0;
            System.out.println("\nIn attesa del server");
            try {
                for (int i = 0; i < maxNumeri; i++) {
                    byte[] bufferIn = new byte[1024];
                    DatagramPacket pktIn = new DatagramPacket(bufferIn, bufferIn.length);
                    sck.receive(pktIn);
                    System.out.format("Numero n. %d/%d: ", i + 1, maxNumeri);
                    String af = new String(pktIn.getData(), 0, pktIn.getLength(), StandardCharsets.UTF_8);
                    System.out.print(af + '\n');
                    if (numeri.contains(Integer.parseInt(af))) {
                        System.out.println(frasi[count++]);
                    }
                }
            } finally {
                sck.leaveGroup(ipMulticast);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
