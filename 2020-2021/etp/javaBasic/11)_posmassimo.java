package com.company;


import java.util.Arrays;
import java.util.Scanner;

public class Main {

    public static void main(String[] args) {
        int[] vet = {1,2,1,3,4,1,100};

        int idx, max;

        max = vet[0];
        idx = 0;
        for (int i = 1; i < vet.length; i++)
            if (vet[i] > max) {
                max = vet[i];
                idx = i;
            }
        System.out.format("Max: %d\nIdx: %d", max, idx);

    }
}

