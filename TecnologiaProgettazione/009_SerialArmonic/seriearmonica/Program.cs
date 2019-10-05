/*
       File: SerieArmonica.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 25/09/2019
       Descrizione  - Scrivere un programma che, richiesto all'utente un numero intero m, calcoli e
					  visualizzi la somma:

*/
using System;

namespace seriearmonica
{
	class MainClass
	{
		public static void Main(string[] args)
		{
			/// Variables ///
			int m,
				k;
			double harmSeries = 0.0;
            /// Inputs ///
            do
            {
                // Input m 
                Console.Write("Insert the number of terms of the series: ");
                m = Convert.ToInt32(Console.ReadLine());
                // Contoll if m is correct
                if (m <= 0)
                    Console.WriteLine("The number m = {0} is not correct. It must be greater than 0", m);
            } while (m <= 0);
			// Make the harmonic series 
			for (k = 1; k <= m; k++)
			{
                harmSeries += 1.0 / k;
			}

			/// Output ///
			Console.WriteLine("The harmonic number H_{0} is {1}", m,harmSeries);
		}
	}
}