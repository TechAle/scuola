/*
       File: Es1.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 02/10/2019
       Descrizione  -	 Inserire il prezzo di un articolo e il numero di pezzi acquistati; 
 *                     in base al numero di pezzi acquistati viene praticato il seguente sconto:
 *                     nr. pezzi sconto (%)
 *                     1        10
 *                     2        15
 *                     3        20
 *                     4        30
 *                     oltre    40
 *                     
 *                     calcolare il prezzo totale degli acquisti effettuati.
*/
using System;

namespace es2_Classroom_Iterazione_
{
    class Program
    {
        static void Main(string[] args)
        {
            // Variabili
            int nArticoli;
            double sconto,
                   prezzo;

            // Richieste
            Console.Write("N^ articoli: ");
            nArticoli = Convert.ToInt32(Console.ReadLine());
            Console.Write("Prezzo: ");
            prezzo = Convert.ToDouble(Console.ReadLine());
            // Settaggio sconto
            if (nArticoli < 3)
                sconto = 10 + 5 * nArticoli - 1;
            else if (nArticoli < 5)
                sconto = 10 + 5 * nArticoli;
            else
                sconto = 40.0;

            // Stampa prezzo finale
            Console.WriteLine("Prezzo finale: {0}", prezzo - prezzo / sconto);

        }
    }
}
