package com.company;

import java.util.Scanner;

public class Main {

    public static void main(String[] args) {

        final int[][] vettore_1 = new int[][] {
                {1,2},
                {2,3}
        };
        final int[][] vettore_2 = new int[][] {
                {1,2,3},
                {4,5,6}
        };

        vettore_analisi(vettore_1, 1);
        vettore_analisi(vettore_2, 2);

    }

    public static void vettore_analisi(int[][] vettore, int numero) {
        System.out.format("Vet %d:\n", numero);
        int idx = 0,
            idx_riga;
        int max_idx = vettore[0].length;
        for(int[] riga : vettore) {
            System.out.format("Riga %d: [ ", idx);
            idx_riga = 0;
            for(int valore : riga) {
                System.out.format("%d%s", valore, idx_riga++ != max_idx - 1 ? ", " : " ");
            }
            System.out.print("]\n");
            idx++;
        }
        int max = Integer.MIN_VALUE;
        idx = max_idx = 0;
        int somma;
        for(int[] riga : vettore) {
            if ( max < (somma = somma_riga(riga)) ) {
                max = somma;
                max_idx = idx;
            }
            idx++;
        }
        System.out.format("Max riga: %d con indice %d\n", max, max_idx);
    }

    public static int somma_riga(int[] riga) {
        int output = 0;
        for(int valore : riga) {
            output += valore;
        }
        return output;
    }
}


