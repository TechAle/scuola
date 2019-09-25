/*
       File: equazione1gMySol.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 25/09/2019
       Descrizione  -	Scrivere un programma che risolva l'equazione di primo grado ax = b, visualizzando
						a seconda dei casi la soluzione, la scritta equazione indeterminata oppure equazione
						impossibile. I coefficienti reali a e b devono essere richiesti in input all'utente
*/
using System;

namespace equazione1gMySol
{
	class MainClass
	{
		public static void Main(string[] args)
		{
			/// variables ///
			float a,
				b;
			/// inputs ///
			Console.WriteLine("inserire l'acquazione di 1 grado (ax = b)");
			string[] prova = Console.ReadLine().Split('=');
			a = Convert.ToInt32(prova[0].Trim('x'));
			b = Convert.ToInt32(prova[1]);
			/// controll the possibility
			if (a == 0)
				if (b == 0)
					Console.WriteLine("indeterminato ");
				else
					Console.WriteLine("Impossibile ");
			else
				Console.WriteLine("il risultato e {0} ", b / a);
		}
	}
}
