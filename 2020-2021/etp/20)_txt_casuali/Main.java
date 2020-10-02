package com.company;


import java.util.Random;
import java.io.*;

public class Main {

    public static Random r = new Random();

    public static void scrivi(String nome, int n) {

        n += n % 2 == 0 ? 0 : 1;

        try {

            BufferedWriter f = new BufferedWriter(new FileWriter(nome));

            for(int i = 0; i < n / 2; i++) {
                f.write(String.format("%d %d\n", (int) (Math.random() * 10), (int) (Math.random() * 10)));
            }

            f.close();

        } catch (IOException e) {
            e.printStackTrace();
        }

    }


    public static void main(String[] args) {

        scrivi("numeri.txt", 5);

    }

}

