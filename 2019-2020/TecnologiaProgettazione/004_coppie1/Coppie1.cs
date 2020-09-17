/*
       File: Coppie1.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 20/09/2019
       Descrizione  Scrivere un programma che permetta di caricare n coppie di numeri interi, calcoli la
                    somma di ogni coppia e la visualizzi.
*/
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Media
{
	class Program
	{
		static void Main(string[] args)
		{
			// input
			Console.Write("Inserire quante coppia si vogliano: ");
			// for + input
			for(int i=0;i<Convert.ToInt32(Console.ReadLine());i++)
			{
				// input numbers
				Console.WriteLine("Inserire {0}^a coppia", i + 1);
				string[] coppia = Console.ReadLine().Split();
				// output
				Console.WriteLine("Somma della {0}^a coppia: {1}", i + 1, Convert.ToInt32(coppia[1]) + Convert.ToInt32(coppia[0]));
			}
			
		}
	}
}