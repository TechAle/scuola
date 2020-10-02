package com.company;


import java.util.Scanner;

public class Main {

    public static void main(String[] args) {

        Scanner s = new Scanner(System.in);

        System.out.print("n_alunni: ");
        int n_alunni = s.nextInt(),
            somma_voti = 0,
            n_neg = 0,
            voto;

        for(int i = 0; i < n_alunni; i++) {
            System.out.format("Alunno %d voto: ", i+1);
            voto = s.nextInt();
            somma_voti += voto;
            if ( voto < 6 )
                n_neg += 1;
        }
        float perc_voti_neg = (float) n_neg / n_alunni * 100;
        System.out.format("Media voti: %.2f\n" +
                          "Percentuale voti negativi: %.2f\n" +
                          "Percentaule voti positivi: %.2f",
                          (float) somma_voti / n_alunni,
                          perc_voti_neg, 100 - perc_voti_neg);


    }
}

