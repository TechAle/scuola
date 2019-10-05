/*
       File: divisioni.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 02/10/2019
       Descrizione  -	 Scrivere un programma che, richiesto un numero intero, visualizzi tutti i suoi divisori
						 (Suggerimento: ricordiamo che a divide b solo se b mod a = 0).
*/
using System;

namespace Divisori
{
	class MainClass
	{
		public static void Main(string[] args)
		{
			// Variabili
			int numero;
			// Richiesta
			Console.Write("Numero: ");
			numero = Convert.ToInt32(Console.ReadLine());
			// Stampa + Ricerca
			Console.Write("Numeri divisibili:\n1\t");
			for(int i = 2; i<numero/2; i++)
			{
				if ((numero % i) == 0)
					Console.Write(i + "\t");
			}
		}
	}
}
