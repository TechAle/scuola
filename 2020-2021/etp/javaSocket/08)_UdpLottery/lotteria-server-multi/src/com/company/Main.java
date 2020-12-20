package com.company;

import java.util.ArrayList;
import java.util.Random;
import java.io.IOException;
import java.net.DatagramPacket;
import java.net.InetAddress;
import java.net.MulticastSocket;
import java.nio.charset.StandardCharsets;


public class Main {

    final static String gruppo = "225.6.7.8";
    final static int portaMulticast = 6789;
    final static int primoRitardo = 15000; // ms
    final static int secondoRitardo = 10000; // ms

    // Per qualche ragione non riesco a importare la sua libreria, utilizzerò un semplice random
    public static class rClass {
        static Random r;
        static ArrayList<Integer> listaVal;
        public rClass() {
            r = new Random();
        }
        private static void resetVal () {
            listaVal = new ArrayList<Integer>();
        }
        public static int estrazione() {
            int val;
            do {
                val = r.nextInt(99);
            }while (listaVal.contains(val));
            listaVal.add(val);
            return val;
        }
    }
    public static void main(String[] args) {
        byte[] bufferOut;
        rClass randomClass = new rClass();
        try (MulticastSocket sck = new MulticastSocket()) {
            System.out.println("Server avviato.");
            InetAddress ipMulticast = InetAddress.getByName(gruppo);
            while(true) {
                int indice = 0;
                rClass.resetVal();
                Thread.sleep(primoRitardo);
                do {
                    int estratto = rClass.estrazione();

                    bufferOut = Integer.toString(estratto).getBytes(StandardCharsets.UTF_8);
                    DatagramPacket pktOut = new DatagramPacket(bufferOut, bufferOut.length,
                            ipMulticast, portaMulticast);
                    sck.send(pktOut);
                    System.out.format("Inviato valore %s%n", estratto);
                    Thread.sleep(secondoRitardo);
                }while (indice++ != 5);
                System.out.println("Ricomincio");
            }
        } catch (IOException | InterruptedException e) {
            e.printStackTrace();
        }
    }
}
