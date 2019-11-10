/*
       File: Esercizio3.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 10/10/2019
       Descrizione -	Caricare in modo random un vettore di 10 numeri interi con numeri compresi fra 0 e 9
                        (inclusi), stamparlo a video e scrivere l'algoritmo che individui quanti numeri pari e
                        quanti numeri dispari ci sono nel vettore.
*/
using System;

namespace Esercizio1_Classroom_Vettori_
{
    class Program
    {
        static void Main(string[] args)
        {
            // Costanti
            const int N = 10,
                      minRandom = 0,
                      maxRandom = 9;
            // Variabili
            int[] vet = new int[N];
            int nPari = 0;
            // Generazione seed
            var rand = new Random(2019);

            // Caricamento random
            Console.Write("v=[");
            for(int i = 0; i < N; i++)
            {
                // Creazione numeri 
                vet[i] = rand.Next(minRandom, maxRandom+1);
                // Stampa + controllo se è pari o dispari
                if (i > 0)
                    Console.Write(", ");
                Console.Write("{0}",vet[i]);
                if ((vet[i] % 2) == 0)
                    nPari += 1;
            }
            Console.Write("]");

            Console.WriteLine("\nNumero pari: {0}\nNumero dispari: {1}", nPari, N-nPari);

         
        }
    }
}
