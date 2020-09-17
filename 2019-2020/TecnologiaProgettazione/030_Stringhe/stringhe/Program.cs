
*
       File: Stringhe.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 18/10/2019
       Descrizione -	Lezione stringa
*/
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace stringhe
{
    class Program
    {
        static void Main(string[] args)
        {
            string frase = "Hello World!".Trim();
            Console.WriteLine("Stringa {0} lunga {1}", frase.ToUpper(), frase.Length);
            frase = frase.ToUpper();
            if (frase.Contains("Hello"))
                Console.WriteLine("Hello esiste in {0}",frase.IndexOf("Hello"));
            foreach (char element in frase)
            {
                Console.Write(element);
            }
            string stringa1 = "pippo",
                   stringa2 = "baudo";
            if ( stringa1.EndsWith("o") && stringa2.StartsWith("B"))
                if (stringa1.Equals(stringa2))
                {
                    Console.WriteLine("Uguali");
                }else
                {
                    if (string.Compare(stringa1, stringa2) > 0)
                        Console.Write("stringa1 > stringa2");
                    else
                        Console.Write("stringa1 < stringa2");
                    stringa1 = stringa1.Insert(0, "ciao").Remove(1,4).Replace("o","i");
                    stringa2 = stringa1.Substring(5, 3);
                }

            string[] parole = stringa1.Split();
            foreach (string p in parole)
                Console.Write(p, " ");
        }
    }
}
