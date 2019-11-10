/*
       File: Esercizio2.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 16/10/2019
       Descrizione -	Dati due vettori, creare un terzo vettore che contenga prima i dati del primo vettore 
                        e poi i dati del secondo vettore.
*/
using System;

namespace Esercizio1_Classroom_Vettori_
{
	class Program
	{
		static void Main(string[] args)
		{

			// Variabili
			int[] vet1 = { 1, 2 },
				  vet2 = { 3, 4 },
				  vet3 = new int[vet1.Length + vet2.Length];

			for ( int i = 0; i < vet1.Length + vet2.Length; i++)
			{
				if (i < vet1.Length)
					vet3[i] = vet1[i];
				else
					vet3[i] = vet2[i - vet1.Length];
			}

			Console.Write("vet3 = [");
			for ( int i = 0; i < vet1.Length + vet2.Length; i ++)
			{
				if (i > 0)
					Console.Write(", ");
				Console.Write("{0}", vet3[i]);
			}
			Console.Write("]");

		}
	}
}
