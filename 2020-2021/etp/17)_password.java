package com.company;


import java.util.Arrays;
import java.util.HashMap;
import java.util.Map;
import java.util.Random;

public class Main {

    final static int MAX_LEN = 12 + 1,
                     MIN_LEN = 6;
    // Questo va a calcolare i valori minimi del dizionario (es se a index 0 abbiamo
    // 1, nella stringa dovremo avere almeno 1 valore che viene compreso nel range
    // Di asci del dizionario ad index 0
    final static int[] min_dizionario = {
            1,
            1,
            1
    };

    final static int[][] dizionario = {
            /// Il primo valore è il numero ascii di partenza,
            /// Il secondo è il numero ascii di fine (sommo di 1 per il random)
            // Minuscole
            {97, 123},
            // Maiuscole
            {65, 91},
            // Numeri
            {49, 58}
    };
    // Random
    static Random rd = new Random();
    // Carattere che riempirà il vettore
    static char padding = ' ';

    public static void main(String[] args) {
        // Creo array vuoto
        char[] password_vettore = new char[MIN_LEN + rd.nextInt(MAX_LEN - MIN_LEN)];
        // Lunghezza generata
        int len_string = password_vettore.length;
        // Riempo l'array
        Arrays.fill(password_vettore, padding);
        /// Inizio a mettere prima di tutto i nostri valori
        // Random index a cui metteremo il valore
        int index;
        int dizionario_scelta;
        for(int i = 0; i < min_dizionario.length; i++) {

            do {
                index = rd.nextInt(len_string);
            }while(password_vettore[index] != ' ');
            password_vettore[index] = (char) (dizionario[i][0] + rd.nextInt(dizionario[i][1] - dizionario[i][0]));
        }

        for(int i = 0; i < len_string - min_dizionario.length; i++) {

            do {
                index = rd.nextInt(len_string);
            }while(password_vettore[index] != ' ');
            dizionario_scelta = rd.nextInt(min_dizionario.length);
            password_vettore[index] = (char) (dizionario[dizionario_scelta][0] + rd.nextInt(dizionario[dizionario_scelta][1] - dizionario[dizionario_scelta][0]));
        }

        String password = String.valueOf(password_vettore);

        System.out.print("Password: " + password);

    }

}


