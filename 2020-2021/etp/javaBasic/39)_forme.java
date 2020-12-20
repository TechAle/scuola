package com.company;

import java.util.Scanner;

public class Main {

    public static void main(String[] args) {

        Scanner s = new Scanner(System.in);

        System.out.print("N: ");
        final int n = s.nextInt();

        float[] formaggi = new float[n];
        float peso_medio = 0;

        for(int i = 0; i < n; i++ ) {
            System.out.format("Forma %d/%d: ", i+1, n);
            formaggi[i] = s.nextFloat();
            peso_medio += formaggi[i];
        }
        int scarti = 0;
        for(float formaggio : formaggi) {
            scarti += formaggio > 14.8 && formaggio < 15.2 ? 1 : 0;
        }

        System.out.format("Formaggi scartati: %d\nFormaggi non scartati: %d\nPeso medio: %.2f",
                scarti,
                n - scarti,
                peso_medio / n);



    }
}
