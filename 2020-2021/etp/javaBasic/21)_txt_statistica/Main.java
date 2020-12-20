package com.company;


import java.util.Random;
import java.io.*;
import java.util.Scanner;

public class Main {

    public static Random r = new Random();

    public static void leggi(String nome_input) {

        try {
            Scanner s = new Scanner(new FileReader(nome_input));
            BufferedWriter f = new BufferedWriter(new FileWriter("statistiche.txt"));
            int riga = 1;
            int val1, val2;
            while ( s.hasNext() ) {
                val1 = s.nextInt();
                val2 = s.nextInt();
                f.write(String.format("Riga %d : Somma %d Media %.2f\n", riga++, val1 + val2, (val1 + val2) / 2.0));
            }
            s.close();
            f.close();

        } catch (IOException e) {
            e.printStackTrace();
        }

    }


    public static void main(String[] args) {

        leggi("numeri.txt");

    }

}

