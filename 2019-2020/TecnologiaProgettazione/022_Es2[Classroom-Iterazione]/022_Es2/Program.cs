/*
       File: Es3.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 02/10/2019
       Descrizione  -	 Calcolare il risultato di una moltiplicazione senza l'operatore *.
*/
using System;

namespace _Es2
{
	class MainClass
	{
		public static void Main(string[] args)
		{
			int n1, n2,
				ris = 0;

			Console.Write("N1: ");
			n1 = Convert.ToInt32(Console.ReadLine());
			Console.Write("N2: ");
			n2 = Convert.ToInt32(Console.ReadLine());

			for( int i = 0 ; i < n2 ; i++ )
			{
				ris += n1;
			}

			Console.WriteLine("Risultato: {0}", ris);
		}
	}
}
