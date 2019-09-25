/*
       File: sconto.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 20/09/2019
       Descrizione  Un negoziante per ogni spesa di importo superiore a 100 € effettua uno sconto del 5%,
                    del 10% per ogni spesa superiore a 300 €. Scrivere un programma che richieda all'utente
                    l'ammontare della spesa e visualizzi quindi l'importo effettivo da pagare
*/
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Sconto_
{
	class Program
	{
		static void Main(string[] args)
		{
			/// Variables
			int sconto = 0;
			// input
			Console.Write("Inserire il costo totale (Euro) ");
			float choose = Convert.ToInt32(Console.ReadLine());
			// check
			if (choose > 100 && choose < 300)
				sconto = 5;
			else if (sconto >= 300)
				sconto = 10;
			// print 
			Console.Write("Prezzo finale: {0}", choose - choose * sconto / 100);

			
		}
	}
}