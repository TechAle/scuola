package com.company;


import java.util.*;

public class Main {


    public static void main(String[] args) {

        int[] alfabeto = new int[26];
        Arrays.fill(alfabeto, 0);

        Scanner s = new Scanner(System.in);
        System.out.print("Stringa: ");
        String stringa = s.nextLine();
        int valore;
        for(char lettera : stringa.toCharArray()) {
            valore = lettera - 97;
            if ( valore < alfabeto.length && valore > -1)
                alfabeto[lettera - 97]++;
        }

        for(int i = 0; i < alfabeto.length; i++) {
            if ( alfabeto[i] > 0 )
                System.out.format("%c : %d\n", (char) 97 + i, alfabeto[i]);
        }

    }

}


