/*
       File: Esercizio1.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 16/10/2019
       Descrizione -	Dato un vettore di 10 numeri interi caricato da programma, stampare la somma e la media
                        dei valori in esso contenuti.
*/
using System;

namespace Esercizio1_Classroom_Vettori_
{
	class Program
	{
		static void Main(string[] args)
		{
			// Costanti
			const int N = 2;
			// Variabili
			int[] vet = new int[N];
			int somma = 0;		

			for (int i = 0; i < N; i++)
			{
				// Richiesta valori
				Console.Write("{0} Valore: ",i+1);
				vet[i] = Convert.ToInt32(Console.ReadLine());
				somma += vet[i];
			}


			Console.WriteLine("Somma: {0}\nMedia: {1}",somma,(double)somma/N);


		}
	}
}
