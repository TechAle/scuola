package com.company;

import java.util.Scanner;

public class Main {

    public static void main(String[] args) {

        int n = 5;
        int neg_som = 0, pos_som = 0, neg_n = 0, num;
        Scanner s = new Scanner(System.in);
        System.out.print("N: ");
        n = s.nextInt();

        for(int i = 0; i < n; i++) {
            System.out.format("N^%d: ", i +1);
            num = s.nextInt();
            if ( num % 2 == 0 )
                pos_som += num;
            else {
                neg_som += num;
                neg_n += 1;
            }
        }

        System.out.format("Positivi: %.2f\nNegativi: %.2f", (float) pos_som / (n - neg_n), (float) neg_som / neg_n);

    }
}
