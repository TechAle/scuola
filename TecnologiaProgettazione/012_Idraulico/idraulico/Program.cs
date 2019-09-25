/*
       File: idraulico.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 25/09/2019
       Descrizione  -	Un idraulico chiede € 40,00 per un'ora di lavoro, più il costo del materiale, con un
						minimo di € 100,00 per ogni lavoro. Scrivere un programma che, dati in input il costo del materiale
						e il numero di ore lavorative, determini la spesa totale, facendola ammontare al limite minimo
						quando previsto
*/
using System;

namespace idraulico
{
	class MainClass
	{
		public static void Main(string[] args)
		{
			/// variables ///
			float	costo,
					forH = 40,
					Dmin = 100,
					h;
			/// inputs ///
			Console.WriteLine("inserire il costo dei materiali ");
			costo = Convert.ToSingle(Console.ReadLine());
			Console.WriteLine("inserire le ore ");
			h = Convert.ToSingle(Console.ReadLine());
			/// output ///
			Console.WriteLine("il costo finale e {0}", Dmin + costo + h * forH);
		}
	}
}
