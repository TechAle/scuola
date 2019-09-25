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
			/// variables ///
			int n,
				i,
				number;
			float serieArm;
			/// inputs ///
			// input n for choose the mumber of numbers
			Console.WriteLine("insert the number of numbers you want");
			n = Convert.ToInt32(Console.ReadLine());
			/// sum of the numbers ///
			number = 0;
			serieArm = 0;
			for (i = 0; i < n; i++)
			{
				number += i + 1;
				if (i < 5)
				{
					serieArm += 1 / ((float) i + 1);
					Console.WriteLine("{0}", serieArm);
				}
			}

			/// output ///
			Console.WriteLine("the SerialArmonic of 5 numbers is {0} and the sum of all numbers is {1}", serieArm, number);
		}
	}
}