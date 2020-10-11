package com.company;

import java.util.Random;
import java.io.*;
import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        // Input input output file
        Scanner s = new Scanner(System.in);
        System.out.print("Input + Output: ");
        String  nome_input = s.next(),
                nome_output = s.next(),
                unita_misura;
        // Informazioni da ricavare
        float perimetro = 0, area = 0;
        // Analizzo input
        try {
            Scanner in_ = new Scanner(new FileReader(nome_input));
            BufferedWriter f = new BufferedWriter(new FileWriter(nome_output));
            // Prendo le prime 2 informazioni
            unita_misura = in_.nextLine();
            final int N = in_.nextInt();
            // Leggo il file
            float[] x = new float[N], y = new float[N];
            for(int i = 0; i < N; i++) {
                x[i] = in_.nextFloat();
                y[i] = in_.nextFloat();
            }
            /// Formula Perimetro
            // ∑(N-1)(i=0)
            for(int i = 0; i < N; i++) {
                //                sqrt           x[(i+1)modN)]            - x[i] ^2              y[(i+1)modN)]            - y[i]  ^2
                perimetro += Math.sqrt(Math.pow((x[Math.floorMod(i+1, N)] - x[i]),2) + Math.pow((y[Math.floorMod(i+1, N)] - y[i]),2));
            }
            /// Formula area
            // ∑(N-1)(i=0)
            for(int i = 0; i < N; i++) {
                //      |        x[i] * y[(i+1)modN]             -x[ (i+1)modN)             * y[i] |
                area += Math.abs(x[i] * y[Math.floorMod(i+1, N)] - x[Math.floorMod(i+1, N)] * y[i]);
            }
            // 1/2
            area /= 2;

            String output = String.format("Perimetro:\t%.2f %s\n\t Area:\t%.2f %s", perimetro, unita_misura, area, unita_misura);

            System.out.print(output);
            f.write(output);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

}

