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
            const double forH = 40.0;       // Costo orario ( Euro )
            const double dMin = 100.0;      // Importo minimo da pagare ( Euro )
			/// variables ///
           
			double	costoMateriale, h, costoFinale;
			/// inputs ///
			Console.Write("Costo dei materiali ( Euro ): ");
			costoMateriale = Convert.ToDouble(Console.ReadLine());
			Console.Write("Numero di ore: ");
			h = Convert.ToDouble(Console.ReadLine());
            // Elaborazione dati
            costoFinale = costoMateriale + h * forH;
            if (costoFinale < dMin)
                costoFinale = dMin;

			/// output ///
			Console.WriteLine("Costo finale: {0:N2} Euro", costoFinale);
		}
	}
}
