/*
       File: Esercizio6.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 18/10/2019
       Descrizione -	Dati due vettori, creare un vettore che contenga solo i numeri pari e un vettore che
                        contenga solo i numeri dispari.
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
				  vetPari = new int[vet1.Length + vet2.Length],
				  vetDispari = new int[vet1.Length + vet2.Length];
			int iPari, iDispari, val;
			iPari = iDispari = 0;

			for ( int i = 0; i < vet1.Length + vet2.Length; i++)
			{
				// Prendere il valore da analizzare
				if (i < vet1.Length)
					val = vet1[i];
				else
					val = vet2[i - vet1.Length];
				// Analisi del valore
				if ( val % 2 == 0)
					vetPari[iPari++] = val;
				else
					vetDispari[iDispari++] = val;
					
			}

            // Stampe
			
			Console.Write("VetDispari = [");
			for (int i = 0; i < iDispari; i++)
			{
				if (i > 0)
					Console.Write(", ");
				Console.Write("{0}", vetDispari[i]);
			}
			Console.Write("]");

			Console.Write("VetPari = [");
			for (int i = 0; i < iPari; i++)
			{
				if (i > 0)
					Console.Write(", ");
				Console.Write("{0}", vetPari[i]);
			}
			Console.Write("]");

		}

	}


}
