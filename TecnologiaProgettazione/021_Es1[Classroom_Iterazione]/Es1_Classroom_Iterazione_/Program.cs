/*
       File: Es1.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 02/10/2019
       Descrizione  -	 Visualizza la sequenza di numeri interi da 10 a 1 utilizzando:
 *                        - ciclo for
 *                        - ciclo while
 *                        - ciclo do ... while
*/
using System;

namespace Es1_Classroom_Iterazione_
{
	class MainClass
	{
		public static void Main(string[] args)
		{
			int i;
			Console.WriteLine("Ciclo for:");
			for (i = 10; i >= 1; i--)
				Console.Write("{0} ", i);
			Console.WriteLine("\nCiclo while");
			i = 10;
			while ( i >= 1 )
			{
				Console.Write("{0} ", i);
				i--;
			}
			Console.WriteLine("Ciclo do-while");
			do
			{
				Console.Write("{0} ", i);
				i--;
			} while (i >= 1);
		}
	}
}
