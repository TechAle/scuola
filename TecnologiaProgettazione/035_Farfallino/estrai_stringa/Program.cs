/*
       File: estrai_stringa.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 24/10/2019
       Descrizione -	Data una stringa, trasformarla in alfabeto farfallino
                        Suggerimento: utilizzare il metod insert
                        Esempio
                        "uomo" --> "ufuofomofo"
                        "pippo" --> "pifippofo"
*/
using System;

namespace estrai_stringa
{
    class MainClass
    {
        public static void Main(string[] args)
        {
            string stringa = "uomo";
            string copia = stringa;
            int cont1,
                cont2;
            cont1 = cont2 = 0;

            for (cont1 = 0; cont1 < stringa.Length; cont1++)
            {
                if ("aeiouAEIOU".IndexOf(stringa[cont1]) >= 0)
                {
                    copia = copia.Insert(cont2, string.Concat(copia[cont2], 'f'));
                    cont2 += 2;
                }
                cont2 += 1;
            }
            Console.Write("Stringa farfallina: {0}", copia);
        }
    }
}
