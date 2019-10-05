/*
       File: Media2.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 25/09/2019
       Descrizione: Dati n numeri reali, scrivere un programma che calcoli la media aritmetica dei valori pari
					e quella dei valori dispari.
*/
using System;

namespace Media2
{
	class Program
	{
		static void Main(string[] args)
		{
			/// Variables ///
			int choose,
				i;
            // modifica poi in intero e aggiungere npari e ndispari, e poi nell'output fa un cast
			float MediaP,
				  MediaS,
				  nChoose;

			/// input ///
			Console.WriteLine("Insert how much numbers you want");
			choose = Convert.ToInt32(Console.ReadLine());

			// loop for input the numbers and for make the avarange of these
			MediaP = MediaS = 0;
			for (i = 0; i < choose; i++)
			{
				Console.WriteLine("Input the {0} number", i + 1);
				nChoose = Convert.ToSingle(Console.ReadLine());
				if (nChoose % 2 == 0)
					MediaP += nChoose;
				else
					MediaS += nChoose;
			}
			MediaP /= choose;
			MediaS /= choose;

			/// output ///
			Console.WriteLine("the avarange of even numbers is {0}\nthe avarange of odd numbers is {1}", MediaP, MediaS);


		}
	}
}
