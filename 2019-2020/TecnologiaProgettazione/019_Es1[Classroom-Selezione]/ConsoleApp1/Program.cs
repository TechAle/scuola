/*
       File: Es1.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 11/10/2019
       Descrizione  -	Risolvere un’equazione di II grado.
*/
using System;

namespace ConsoleApp1
{
    class Program
    {
        static void Main(string[] args)
        {
            // Variabili
            const double TOLL = 1E-10;
            double  a, b, c,
                    x1, x2,
                    delta;

            // Richiesta
            Console.Write("Coefficente a: ");
            a = Convert.ToDouble(Console.ReadLine());
            Console.Write("Coefficente b: ");
            b = Convert.ToDouble(Console.ReadLine());
            Console.Write("Coefficente c: ");
            c = Convert.ToDouble(Console.ReadLine());

            // Elaborazione: Calcolo ed esamine del delta
            delta = b*b - 4*a*c;

            if (Math.Abs(delta) < TOLL)
            {
                // Delta ~ == 0 -> 1 soluzione
                x1 = -b / (2.0 * a);
                Console.WriteLine("1 soluzione: {0}", x1);
            }
            // Delta > 0 -> 2 soluzioni

            else if (delta > 0)
            {
                x1 = (-b + Math.Sqrt(delta)) / (2.0 * a);
                x2 = (-b - Math.Sqrt(delta)) / (2.0 * a);
                Console.WriteLine("x1\t{0}\nx2\t{1}", x1, x2);
            }
            // Delta < 0 -> impossibile
            else
                Console.WriteLine("Impossibile");
        }
    }
}
