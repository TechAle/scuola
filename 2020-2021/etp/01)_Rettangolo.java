package com.company;

import java.util.Scanner;

public class Main {

    public static void main(String[] args) {
        float base, altezza, larghezza;
        System.out.print("Base Altezza Larghezza: ");
        Scanner inputs = new Scanner(System.in);
        base = inputs.nextFloat();
        altezza = inputs.nextFloat();
        larghezza = inputs.nextFloat();
        System.out.format("Superfice totale: %.2f\n" +
                          "Volume totale: %.2f",
                          base * larghezza * 6,
                          base * larghezza * altezza);
    }
}
