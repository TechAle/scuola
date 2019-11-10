/*
       File: assicurazioni.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 25/09/2019
       Descrizione  -	All'inizio in un nuovo anno, un'agenzia deve adeguare gli importi delle assicurazioni
						delle automobili sulla base degli incidenti registrati nell'anno precedente: se un'automobile non ha
						subito incidenti, l'importo è ridotto del 4%; in caso contrario, l'importo è aumentato del 12%.
						Scrivere un programma che, richiesti in input l'importo e il numero di incidenti dell'anno
						precedente di N automobili, determini e visualizzi il nuovo importo da pagare per ciascuna
						assicurazione. Il programma deve inoltre stampare il totale degli importi previsti per il nuovo anno.
*/
using System;

namespace assicurazioni
{
	class MainClass
	{
		public static void Main(string[] args)
		{
			/// Variabili
			int incidenti,
				nAuto;
			float importo,
				  importoFinale = 0;
			
			/// Input
			Console.Write("Importo: ");
			importo = Convert.ToSingle(Console.ReadLine());
			Console.Write("Macchine: ");
			nAuto = Convert.ToInt32(Console.ReadLine());
			Console.Write("Incidenti: ");
			incidenti = Convert.ToInt32(Console.ReadLine());
			/// Elaborazione dati
			for(int i = 0; i<nAuto;i++)
			{
				if (incidenti == 0)
					importoFinale += importo - importo * 4 / 100;
				else
					importoFinale += importo + importo * 12 / 100;
				// Tolgo 1 incidente siccome è come se sopra togliessi 1 macchina a ciclo
				incidenti--;
			}
			/// Stampa
			Console.WriteLine("Importo finale: {0}", importoFinale);

		}
	}
}
