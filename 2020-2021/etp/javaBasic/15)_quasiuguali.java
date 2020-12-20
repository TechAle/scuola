package com.company;


import java.util.*;

public class Main {


    public static void main(String[] args) {

        Scanner s = new Scanner(System.in);
        System.out.print("Stringhe: ");
        String stringa1 = s.nextLine();
        String stringa2 = s.nextLine();
        if ( stringa1.equals(stringa2) )
            System.out.print("Stringhe uguali");
        else if (stringa1.toLowerCase().equals(stringa2.toLowerCase()))
            System.out.print("Stringhe semi uguali");
        else
            System.out.print("Stringhe diverse");
    }

}


