package com.company;


import java.util.Random;
import java.io.*;
import java.util.Scanner;

public class Main {

    public static Random r = new Random();

    public static int conta_lettere(String riga, char aim) {
        int count = 0;
        for(char lettera : riga.toCharArray()) {
            if ( lettera == aim )
                count++;
        }
        return count;
    }

    public static int leggi(String nome_input) {

        int output;

        try {
            Scanner s = new Scanner(new FileReader(nome_input));
            output = 0;
            String riga;
            while ( s.hasNext() ) {
                riga = s.nextLine();
                output += conta_lettere(riga, 'S');
            }
            s.close();

        } catch (IOException e) {
            e.printStackTrace();
            output = -1;
        }

        return output;

    }


    public static void main(String[] args) {

        System.out.print(leggi("string.txt"));

    }

}

