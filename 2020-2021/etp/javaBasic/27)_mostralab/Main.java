package com.company;


import java.util.Random;
import java.io.*;
import java.util.Scanner;

public class Main {

    public static Random r = new Random();


    public static void leggi(String nome_input) {

        try {
            Scanner s = new Scanner(new FileReader(nome_input));
            int i = 0;
            String riga;
            while ( s.hasNext() ) {
                if ( i < 2 )
                    System.out.print("+-----------+-----------+-----------+-----------+\n");
                riga = s.nextLine();
                String[] split = riga.split(" ");

                for(String parte: split) {
                    System.out.format("|\t%s\t", parte);
                }
                System.out.format(i > 0 ? "\t|" : "|");

                System.out.print('\n');

                i++;
            }
            System.out.print("+-----------+-----------+-----------+-----------+\n");
            s.close();
        } catch (IOException e) {
            e.printStackTrace();
        }


    }


    public static void main(String[] args) {
        leggi("string.txt");

    }

}

