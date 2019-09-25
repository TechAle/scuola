/*
       File: Media1.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 20/09/2019
       Descrizione  Scrivere un programma che calcoli e visualizzi la media di n numero interi immessi
                    dall'utente.
*/
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Media
{
    class Program
    {
        static void Main(string[] args)
        {
            /// Variables
            int choose,
                i;
            float media;

            // input
            Console.WriteLine("Inserire quanti numeri");
            choose = Convert.ToInt32(Console.ReadLine());

            // for choose
            media = 0;
            for(i=0;i<choose;i++)
            {
                Console.WriteLine("inserire {0} numero", i + 1);
                media += Convert.ToSingle(Console.ReadLine());
            }
            media /= choose;

            // print
            Console.WriteLine("media: {0}", media);

            // for keep console open until key press
            Console.ReadKey();


        }
    }
}
