/*
       File: Esercizio2.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 16/10/2019
       Descrizione -	Dato un vettore di 10 numeri interi caricato da programma, trovare
	   il minimo e massimo e stamparne la posizione
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
			int min_pos = 0,
				max_pos = 0;		

			for (int i = 1; i < N; i++)
			{
				// Richiesta valori
				Console.Write("{0} Valore: ",i+1);
				vet[i] = Convert.ToInt32(Console.ReadLine());
				if (vet[min_pos] > vet[i])
					min_pos = i;
				else if (vet[max_pos] < vet[i])
					max_pos = i;
			}


			Console.WriteLine("Minimo {0} a posizione {1}\nMassimo {2} a posizione {3}",vet[min_pos],min_pos,vet[max_pos],max_pos);


		}
	}
}
