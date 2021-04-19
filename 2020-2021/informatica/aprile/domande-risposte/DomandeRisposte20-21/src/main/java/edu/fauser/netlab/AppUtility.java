/*
               File: AppUtility.java
   Applicazione web: Domande & Risposte

             Autore: Roberto FULIGNI
    Ultima modifica: 18/03/2021

        Descrizione: Funzioni di utilità per l'applicazione.

*/

package edu.fauser.netlab;

import java.sql.SQLWarning;

public class AppUtility {
    public static String escapeHTML(String str) {
        StringBuilder sb = new StringBuilder(str.length());
        for (int i = 0; i < str.length(); i++) {
            char ch = str.charAt(i);
            if (ch == '&' || ch == '"' || ch == '<' || ch == '>' || ch > 127) {
                sb.append(String.format("&#%d;", (int) ch));
            } else {
                sb.append(ch);
            }
        }
        return sb.toString();
    }

    public static void mostraErroreSql(SQLWarning warning) {
        // Stampa l'avvertimento nella console del Container
        if (warning != null) {
            System.out.println("n---Warning---n");
            do {
                System.out.println("Message: " + warning.getMessage());
                System.out.println("SQLState: " + warning.getSQLState());
                System.out.print("Vendor error code: ");
                System.out.println(warning.getErrorCode());
                System.out.println("");
                warning = warning.getNextWarning();
            }
            while (warning != null);
        }

    }
}
