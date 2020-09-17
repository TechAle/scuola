/*
       File: Targhe.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 06/10/2019
       Descrizione -	Generare casualmente una targa italina
*/
using System;

namespace Targhe
{
    class Program
    {
        static void Main(string[] args)
        {
            // Generazione seed
            Random r = new Random(0);
            Console.WriteLine("Targa: {0}",string.Concat((char)('a' + r.Next(0,26)), (char)('a' + r.Next(0, 26)),r.Next(100,1000), (char)('a' + r.Next(0, 26)), (char)('a' + r.Next(0, 26))));
        }
    }
}
