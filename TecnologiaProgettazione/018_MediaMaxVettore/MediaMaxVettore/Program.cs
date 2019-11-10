/*
       File: MediaMaxVettore.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 04/09/2019
       Descrizione  -	dato un vettore di 5 elementi inseriti da tastiera, 
                        determinare la media e il masso,o elemento contenuto nel vettore
*/
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace MediaMaxVettore
{
    class Program
    {
        static void Main(string[] args)
        {
            const int DIM = 5;
            int[] v = new int[DIM];

            /*Fase 1: acquisizione dei valore da tastiera
             * e memorizzazione del vettore*/
            for (int i = 0; i < DIM; i++)
            {
                Console.Write("v[{0}] = ", i);
                v[i] = Convert.ToInt32(Console.ReadLine());
            }
            /*Fase 2: Elaborazione dei dati
             * Calcolo della media e max*/
            int somma = 0;
            int max = Int32.MinValue;
            for (int i = 0; i < DIM; i++)
            {
                somma += v[i];
                if (v[i] > max)
                    max = v[i];
                    
            }
            double media = (double)somma / DIM;
            Console.WriteLine("Media: {0:N3}\nMax: {1}", media,max);

        }
    }
}
