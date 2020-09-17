/*
       File: vocali_consonanti_simboli.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 24/10/2019
       Descrizione -	Data una stringa, contare il numero di vocali, consonanti, altri simboli presenti
*/
using System;

namespace vocali_consonanti_simboli
{
    class MainClass
    {
        public static void Main(string[] args)
        {
            // Inizializzazione di una stringa
            string stringa1 = "aebc#?";
            // Contatori
            int vocali,
                consonanti,
                simboli;
            // Li inizializzo a valore 0
            vocali = consonanti = simboli = 0;
            // Analizzo stringa1
            foreach (char carattere in stringa1)
                if (!char.IsLetter(carattere))
                    simboli++;
                else
                if ("aeiouAEIOU".IndexOf(carattere) >= 0)
                    vocali++;
                else
                    consonanti++;
            // Stampo
            Console.Write("{0} contiene:\nvocali: {1}\nconsonanti: {2}\nsimboli: {3}",stringa1,vocali,consonanti,simboli);
        }
    }
}