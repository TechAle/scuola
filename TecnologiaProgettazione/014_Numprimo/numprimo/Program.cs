/*
       File: numprimo.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 02/10/2019
       Descrizione  -	  Scrivere un programma che, richiesto un numero intero, stabilisca se questo è primo
						  (Suggerimento: sfruttare il precedente esercizio). b mod a = 0).
*/
using System;

namespace Divisori
{
	class MainClass
	{
		public static void Main(string[] args)
		{
			/// Variabili
			int numero;
			/// Richiesta
			Console.Write("Numero: ");
			numero = Convert.ToInt32(Console.ReadLine());
			/// Ricerca
			Primo(numero);
			
			
			
			
		}
        // Algoritmo per verificare se un numero e primo
		public static void Primo(int numero)
		{
            if (numero == 1 || numero == 0)
                Console.WriteLine("{0} e primo ", numero);
            else
            {
                int i = 2;
                do
                {
                    
                    if ((numero % i) == 0)
                    {
                        // E il valore che fa uscire dal ciclo
                        Console.WriteLine("{0} non e primo", numero);
                        i = Int32.MinValue;
                       
                    }
                    else i++;

                } while (i < numero / 2 && i != Int32.MinValue);
                if (i != Int32.MinValue)
                    Console.WriteLine("{0} e primo", numero);
            }
		}
	}
}
