package com.company;

import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Scanner;
import java.util.Random;

public class Main {

    final static int   righe = 3,
                colonne = 5;

    final static int[][] tabellone = new int[righe][colonne];
    static ArrayList<Integer> numeri_usciti = new ArrayList<Integer>();

    final static Random r = new Random();


    public static void main(String[] args) {
        int valore;
        for(int i = 0; i < righe; i++)
        {
            for(int j = 0; j < colonne; j++) {
                do
                {
                    valore = r.nextInt(90) + 1;
                }while (numeri_usciti.contains(valore));
                numeri_usciti.add(valore);
                tabellone[i][j] = valore;
            }
        }

        Scanner s = new Scanner(System.in);
        System.out.print("Nome file: ");
        String output = s.next();

        try {
            BufferedWriter f = new BufferedWriter(new FileWriter(output));
            for (int[] riga : tabellone) {
                for (int cellula : riga) {
                    f.write(String.format("%d\t", cellula));
                }
                f.write('\n');
            }
            f.close();
        } catch ( IOException e) {
            e.printStackTrace();
        }

    }
}
