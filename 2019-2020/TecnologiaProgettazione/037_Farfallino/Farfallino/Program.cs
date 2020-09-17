/*
       File: Farfallino_stringbuild.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 06/10/2019
       Descrizione -	Data una stringa, trasformarla in alfabeto farfallino
                        Suggerimento: utilizzare il metod insert
                        Esempio
                        "uomo" --> "ufuofomofo"
                        "pippo" --> "pifippofo"
                        Usare lo stringBuild
*/
using System;
using System.Text;

namespace estrai_stringa
{
    class MainClass
    {
        public static void Main(string[] args)
        {
            // Inizializzo la stringa
            string stringa = "uomo";
            // Inizializzo una stringbuild con la frase di stringa
            StringBuilder copia = new StringBuilder(stringa);
            int cont1,
                cont2 = 1;

            for (cont1 = 0; cont1 < stringa.Length; cont1++)
            {
                // Controllo se è una vocale
                if ("aeiouAEIOU".IndexOf(stringa[cont1]) >= 0)
                {
                    // Metti dentro
                    copia.Insert(cont2,string.Concat('f', copia[cont2-1]));
                    cont2 += 2;
                }
                cont2 += 1;
            }
            Console.Write("Stringa farfallina: {0}", copia);
        }
    }
}