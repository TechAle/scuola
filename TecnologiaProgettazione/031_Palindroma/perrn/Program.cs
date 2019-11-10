/*
       File: Palindroma.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 24/10/2019
       Descrizione -	Data una parola, verificare se è palindroma
                        Esempio
                        "pippo" --> non palindroma
                        "anna" --> palindroma
*/
using System;

namespace palindroma
{
    class MainClass
    {
        public static void Main(string[] args)
        {
            // Inizializzazione di una stringa
            string stringa1 = "cdcc";
            // Creo una stringa che comprenda la metà di stringa1
            string meta = stringa1.Substring(stringa1.Length / 2);
            int i = 0;
            // Controllo se sono uguali
            do
            {
                if (meta[meta.Length - 1 - i] == stringa1[i])
                    i += 1;
            // Continua finchè o sono diversi oppure i è maggiore della metà di stringa1
            } while (i < stringa1.Length / 2 && stringa1[i] == meta[meta.Length-1-i]);
            // Per verificare se ha avuto successo controllo l'indice
            if (i >= stringa1.Length / 2)
                Console.Write("{0} E palindroma",stringa1);
            else
                Console.Write("{0} Non e palindroma",stringa1);
        }
    }
}