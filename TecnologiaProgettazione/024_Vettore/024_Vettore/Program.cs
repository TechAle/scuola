/*
       File: numprimo.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 10/10/2019
       Descrizione -	Dato un vettore di 5 elementi calcolare la media e il massimo
*/
using System;

namespace _Vettore
{
	class MainClass
	{
		public static void Main(string[] args)
		{
			// Variabili
			int [] vett = new int[5];
			int max = Int32.MinValue,
				somma = 0;

			for ( int i = 0; i < 5; i++)
			{
				Console.Write("N^{0} valore: ", i + 1);
				vett[i] = Convert.ToInt32(Console.ReadLine());

				somma += vett[i];
				if (vett[i] > max)
					max = vett[i];
			}

			Console.Write("Media: {0}\nMassimo: {1}", somma / 5.0, max);


			
		}
	}
}
