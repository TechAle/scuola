package com.company;


import java.util.Random;
import java.io.*;
import java.util.Scanner;

public class Main {
    public static void leggi(String nome_input) {
        int max = Integer.MIN_VALUE;
        int min = Integer.MAX_VALUE;
        try {
            Scanner s = new Scanner(new FileReader(nome_input));
            BufferedWriter f = new BufferedWriter(new FileWriter("min_max.txt"));
            int value;
            while (s.hasNext()) {
                max = Math.max(max, (value = s.nextInt()));
                min = Math.min(min, value);
            }
            f.write(String.format("Min: %d\nMax: %d", min, max));
            f.close();
            s.close();
        } catch (IOException e) {
            e.printStackTrace();
        }


    }


    public static void main(String[] args) {
        leggi("string.txt");

    }

}

