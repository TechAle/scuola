package com.company;

import java.util.Scanner;

public class Main {

    public static void main(String[] args) {
        int ore;
        System.out.print("Ore: ");
        Scanner inputs = new Scanner(System.in);
        ore = inputs.nextInt();
        if ( ore < 1 )
            System.out.println("Orario non disponibile");
        else {
            System.out.print("Costo totale: " + 2.5 + (ore - 1) * 1.5);
        }
    }
}
