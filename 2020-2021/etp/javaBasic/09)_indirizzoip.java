package com.company;

import java.util.Random;
import java.util.Scanner;

public class Main {

    public static void main(String[] args) {

        int[] ip = new int[4];
        Random rand = new Random();
        char classe;
        for(int i = 0; i < 4; i++) {
            ip[i] = rand.nextInt(256 /* 255 (il massimo che vogliamo) + 1 */);
        }
        
        if (ip[0] < 128)
            classe = 'A';
        else if (ip[0] < 192)
            classe = 'B';
        else if (ip[0] < 224)
            classe = 'C';
        else if (ip[0] < 240)
            classe = 'D';
        else
            classe = 'E';

        System.out.print("Ip: ");
        for(int i = 0; i < 4; i++) {
            System.out.print(ip[i]);
            if ( i < 3 )
                System.out.print('.');
        }

        System.out.print("\nClasse: " + classe);

    }
}

