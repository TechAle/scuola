package com.company;

import edu.fauser.netlab.UniqueRandom;

import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Scanner;
import java.util.Random;

public class Main {

    final static int   righe = 3,
            colonne = 5;

    final static int n_thread = 3;

    static class randomThread extends Thread {

        String nome_output;
        int[][] tabellone = new int[righe][colonne];


        public randomThread(String output, int num) {
            this.nome_output = String.format("%s%d.txt", output, num);
        }

        public void genera_tabella() {
            UniqueRandom r = new UniqueRandom(1, 91);
            int valore;
            for(int i = 0; i < righe; i++)
            {
                for(int j = 0; j < colonne; j++) {
                    this.tabellone[i][j] = r.nextInt();
                }
            }

        }

        public void stampa_file() {
            try {
                BufferedWriter f = new BufferedWriter(new FileWriter(this.nome_output));
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

        @Override
        public void run() {
            genera_tabella();
            stampa_file();
        }

    }

    public static void main(String[] args) {

        Scanner s = new Scanner(System.in);
        System.out.print("Nome file: ");
        String output = s.next();

        randomThread[] pulls = new randomThread[n_thread];

        for(int i = 0; i < n_thread; i++) {
            pulls[i] = new randomThread(output, i + 1);
            pulls[i].run();
        }

        try {
            for(int i = 0; i < n_thread; i++)
                pulls[i].join();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
    }
}
