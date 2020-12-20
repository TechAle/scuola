package com.company;

import java.util.Scanner;

public class Main {

    public static void main(String[] args) {
        double a, b, c, output;
        System.out.print("A B C: ");
        Scanner inputs = new Scanner(System.in);
        a = inputs.nextFloat();
        b = inputs.nextFloat();
        c = inputs.nextFloat();

        if ( (output = Math.pow(b, 2) - 4 * a * c) < 0 )
            System.out.println("Nessuna soluzione");
        else
        if ( output == 0 )
            System.out.println("1 soluzione: " + -b / (2*a));
        else
            System.out.println("2 soluzioni: "
                    + (-b + Math.sqrt(output))/(2*a) + " "
                    + (-b - Math.sqrt(output))/(2*a));

    }
}
