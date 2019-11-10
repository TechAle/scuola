/*
       File: cap.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 04/09/2019
       Descrizione  -	Scrivere un programma che, dati in input n codici di avviamento postale, conti quelli che
						hanno le prime due cifre uguali a 28 e comunichi il risultato (si considerino CAP formati da numeri
						interi a 5 cifre, es. Novara: 28100)
*/
using System;

namespace cap
{
	class MainClass
	{
		public static void Main(string[] args)
		{
			// Variabili
			int n,
				conta28 = 0;
            // Precondizione: l'utente specifica un numero non negativo
            Console.Write("Numero di CAP da inserire: ");
            n = Convert.ToInt32(Console.ReadLine());
			for (int i = 0; i < n ; i++)
			{
                /// Mia vecchia soluzione
                /*
                string cap;
                Console.Write("{0}^ Cap: ", i + 1);
				cap = Console.ReadLine();
				// Controllo lunghezza e se 28 è nelle prime due
				if (cap.Length == 5 && cap.Substring(0, 2) == "28")
					conta28++;
                    */
                /// Soluzione nuova
                int cap;
                Console.Write("CAP n.{0}: ", i + 1);
                cap = Convert.ToInt32(Console.ReadLine());
                if (cap / 1000 == 28)
                    conta28++;
			}
			// Output
			Console.WriteLine("\n{0} CAP che iniziano con la sequenza 28", conta28);
		}
	}
}
