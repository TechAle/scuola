/*
       File: estrai_stringa.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 25/10/2019
       Descrizione -	Data una stringa, estrarre il contenuto compreso tra “OK” e “FINE”
                        NB. Utilizzare i metodi IndexOf per cercare l’occorrenza “OK” e LastIndexOf per cercare
                        l’occorrenza “FINE”; estratti gli indici di “OK” e “FINE”, utilizzarli in modo opportuno con il
                        metod_o substring per estrarre il testo desiderato
                        Esempio.
                        stringa=”oggi OKe’ una bella giornataFINE senza nuvole”
                        estrarre il testo tra le seguenti posizioni
                        posizione iniziale: "OK"
                        posizione finale "FINE"
                        estraggo pertanto:
                        “e’ una bella giornata”
*/
using System;

namespace estrai_stringa
{
    class MainClass
    {
        public static void Main(string[] args)
        {
            // Stringa da analizzare
            string stringa = "oggi OKe’ una bella giornataFINE senza nuvole";
            // Stampa da OK e Fine (all'inizio bisogna sommare 2 siccome 
            // è la lunghezza di Ok invece dopo bisogna sottrarre 2 perchè tolgo OK
            Console.WriteLine("{0}", stringa.Substring(stringa.IndexOf("OK") + 2, stringa.LastIndexOf("FINE")- stringa.IndexOf("OK") + -2));
        }
    }
}
