package com.company;


import java.util.Random;
import java.io.*;
import java.util.Scanner;

public class Main {

    public static Random r = new Random();


    public static void leggi(String nome_input) {

        try {
            Scanner s = new Scanner(new FileReader(nome_input));
            BufferedWriter f = new BufferedWriter(new FileWriter("medie.txt"));
            BufferedWriter o = new BufferedWriter(new FileWriter("esiti.txt"));
            String riga;
            float media;
            int i;
            while ( s.hasNext() ) {
                media = 0;
                riga = s.nextLine();
                String[] split = riga.split(" ");
                for (i = 0; i < split.length; i++) {
                    String parola = split[i];
                    System.out.format("%s ", parola);;
                    if ( i > 1 ) {
                        media += Float.parseFloat(parola);
                    } else {f.write(parola + ' ');o.write(parola + ' ');}
                }
                System.out.print('\n');
                media /= (i-2.0);
                f.write(String.valueOf(media) + '\n');
                o.write((media >= 6 ? "promosso" : "debiti") + '\n');
            }
            s.close();
            f.close();
            o.close();
        } catch (IOException e) {
            e.printStackTrace();
        }


    }


    public static void main(String[] args) {
        leggi("string.txt");

    }

}

