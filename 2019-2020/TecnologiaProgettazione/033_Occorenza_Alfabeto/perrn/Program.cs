/*
       File: vocali_consonanti_simboli.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 25/10/2019
       Descrizione -	Data una frase, contare per ogni lettera dell'alfabeto presente nellafrase il numero di occorrenze
Esempio
*/
using System;

namespace Conta
{
    class MainClass
    {
        public static void Main(string[] args)
        {
            // Inizializzazione di una stringa
            string stringa1 = "alee";
            // Ogni cella contiene un carattere
            int[] conta = new int[26];
            // Inizializzo il vettore a 0
            for (int i = 0; i < 26; i++)
                conta[i] = 0;
            // Analizzo parola
            foreach (char c in stringa1)
            {
                conta[c - 'a']++;
            }
            for (int i = 0; i < 26; i++)
            {
                if (conta[i] > 0)
                    Console.WriteLine("{0}: {1}", (char)('a' + i), conta[i]);
            }
          
        }
    }
}