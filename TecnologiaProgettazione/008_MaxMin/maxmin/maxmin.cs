/*
       File: MinMax.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 25/09/2019
       Descrizione  - Scrivere un programma che determini il maggiore e il minore tra gli n numeri immessi
					  dall'utente.
*/
using System;

namespace maxmin
{
	class MainClass
	{
		public static void Main(string[] args)
		{
			/// variables ///
			int n,
				i,
				number,
				max = int.MinValue,
				min = int.MaxValue;
			/// inputs ///
			// input n for choose the mumber of numbers for make max and min
			Console.WriteLine("insert the number of numbers you want");
			n = Convert.ToInt32(Console.ReadLine());
			// input all numbers + processings it
			for (i = 0; i<n ; i++)
			{
				// input the number
				Console.WriteLine("insert {0} number", i+1);
				number = Convert.ToInt32(Console.ReadLine());
				/// processing numbers to obtain min and max ///
				if (number > max)
					max = number;
				else
				// controll if number is > of min, if yes max number max
				if (number < min)
				{
					min = number;
				}

				
			}
			/// output
			Console.Write("the min is {0}\nmax is {1}", min, max);
		}
	}
}
