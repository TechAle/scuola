/*
       File: imc.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 25/09/2019
       Descrizione  -	Conoscendo il peso P e l'altezza H di una persona, è possibile calcolare l'indice di massa
						corporea (IMC) mediante la formula:
						Scrivere un programma che: richieda l'inserimento del peso (in chilogrammi) e l'altezza (in metri) di
						N persone (dove N è un numero inserito da tastiera) , visualizzando l'indice IMC corrispondente;
						conti il numero di persone aventi IMC superiore a una certa soglia S prefissata (utilizzare il valore
						S = 41.5 kg/m2
						).
*/
using System;

namespace imc
{
	class MainClass
	{
		public static void Main(string[] args)
		{
			/// Variabili
			float peso,
				  altezza;
			int n,
				imcCont = 0;
			// Richieste
			Console.Write("Persone: ");
			n = Convert.ToInt32(Console.ReadLine());
			for (int i = 0; i < n; i++)
			{
				Console.Write("Peso: ");
				peso = Convert.ToSingle(Console.ReadLine());
				Console.Write("altezza: ");
				altezza = Convert.ToSingle(Console.ReadLine());
				// Controlla imc
				if (peso / Math.Pow(altezza,2) > 41.5)
					imcCont++;
			}
			// Stampa risultato
			Console.Write("Imc superiore a 41.5: {0}", imcCont);
		}
	}
}
