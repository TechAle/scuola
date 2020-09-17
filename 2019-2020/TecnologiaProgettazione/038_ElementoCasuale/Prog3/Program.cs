/*
       File: ElementiCasuali.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 21/10/2019
       Descrizione -    Si considerino le seguenti due attività:
                            a)  Generazione di 5 000 000 numeri casuali compresi tra -10 e 20 (seed 2018) e memorizzazione dei
                                valori in un array A; ordinamento crescente di A; determinazione della media aritmetica m dei soli
                                valori contenuti nella prima metà di A (i primi 2 500 000 elementi); visualizzazione del messaggio
                                "Media degli elementi estratti da A: " seguito dal valore di m.
                            b)  Generazione di 3 000 000 numeri casuali compresi tra 51 e 100 (seed 2019) e memorizzazione dei
                                valori in un array B; ordinamento crescente di B; determinazione del numero n di elementi dispari
                                presenti nella prima metà di B; stampa del messaggio "Elementi dispari estratti da B: " seguito
                                dal valore di n.
                        Scrivere un programma Progr1 che esegua le due attività in modo sequenziale riportando il tempo
                        impiegato T1. Scrivere successivamente due programmi Progr2 e Progr3 che eseguano le stesse attività
                        usando un algoritmo parallelo (basato rispettivamente sulla classe Thread e sulla libreria TPL)
                        mostrando il tempo impiegato (rispettivamenteT2 e T3). Determinare lo speedup per ciascuno degli
                        algoritmi paralleli.
*/
using System;
>

namespace Prog3
{
    class MainClass
    {
        public static void Main(string[] args)
        {
            //// Variabili ////
            // Costanti
            const int LUNGHEZZA_A = 5000000;
            // Creazione di un seed
            Random rndA = new Random(2018);
            // Creazione array con dimensione decisa dallo sviluppatore
            int[] A = new int[LUNGHEZZA_A];
            // Creazione di due valori interi per tenere in memoria:
            // In uno la media della metà dei valore totali del primo vettore,
            // Nell'altro i valori dispari della metà dei valore totali del secondo vettore
            float mediaA;
            // Creazione di un cronometro
            Stopwatch cronometro = new Stopwatch();
            // Creazione thread ed avviamento
            Task t = Task.Factory.StartNew(threadB);
            // Attivazione cronometro
            cronometro.Start();
            ////// Vettore A //////
            //// Reperimento dati al vettore ////
            // Rimpe il vettore di numeri casuali
            Input_(A, LUNGHEZZA_A, rndA, -10, 20);
            // Attesa della fine del task
            t.Wait();
            //// Elaborazione dei dati ////
            // Utilizzo della funzione sort per ordinare automaticamente l'array di interi.
            Array.Sort(A);
            // Reperimento della media mediante l'utilizzo di una funzione
            mediaA = Media(A, LUNGHEZZA_A);


            //// Stampa finale di tutte le due media
            cronometro.Stop();
            Console.Write("Media degli elementi estratti da A: {0}\nTempo impiegato: {1} milli secondi", mediaA, cronometro.ElapsedMilliseconds);
        }

        public static void threadB()
        {
            const int LUNGHEZZA_B = 3000000;
            int[] B = new int[LUNGHEZZA_B];
            int nDispari;
            Random rndB = new Random(2019);

            ////// Vettore B //////
            //// Reperimento dati al vettore ////
            // Rimpe il vettore di numeri casuali
            Input_(B, LUNGHEZZA_B, rndB, 51, 100);

            //// Elaborazione dei dati ////
            // Utilizzo della funzione sort per ordinare automaticamente l'array di interi.
            Array.Sort(B);
            // Reperimento del numero degli elementi dispari mediante una funzione
            nDispari = Dispari(B, LUNGHEZZA_B);
            // Stampa
            Console.WriteLine("Elementi dispari estratti da B: {0}", nDispari);
        }

        /*
         * Richiede in input il vettore da riempire,
         * La lunghezza del vettore e il seed e infine
         * 2 valori che rappresentano i valori casuali richiesti in input.
         * Non è previsto nessun valore di ritorno.
         * Questa funzione riempe il vettore di numeri casuali richiesti in input.
         */
        private static void Input_(int[] vet, int lung, Random rnd, int min, int max)
        {
            // Serve per farlo includere
            max += 1;
            for (int i = 0; i < lung; i++)
                // Ci mette dentro un valore casuale fra -10 e 20 (incluso)
                vet[i] = rnd.Next(min, max);

        }

        /*
         * Richiede in input un vettore su cui verranno presi i numeri
         * E la lunghezza del vettore.
         * Questa funzione fà la somma di tutti i valori che stanno prima della metà del vettore per poi farne la media.
         */
        private static float Media(int[] vet, int lung)
        {
            int val = 0;
            // Ciclo per metà lunghezza del vettore
            for (int i = 0; i < lung / 2; i++)
                // Somma effettiva
                val += vet[i];
            // Ritorno il valore
            return val / (float) (lung / 2);
        }

        /*
         * Richiede in input un vettore su cui verranno presi i numeri
         * E la lunghezza del vettore.
         * Questa funzione fà la somma di tutti i valori che stanno prima della metà del vettore per poi farne la media.
         */
        private static int Dispari(int[] vet, int lung)
        {
            int val = 0;
            // Ciclo per metà lunghezza del vettore
            for (int i = 0; i < lung / 2; i++)
                // Controllo se è dispari
                if (vet[i] % 2 != 0)
                    val += 1;
            // Ritorno il valore
            return val;
        }

    }
}
