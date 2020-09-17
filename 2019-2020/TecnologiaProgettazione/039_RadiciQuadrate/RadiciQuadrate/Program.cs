/*
       File: ElementiCasuali.cs
       Autore: Condello Alessandro
       Matricola: 11465
       A.S. 2019-2020
       Ultima modifica: 28/10/2019
       Descrizione - Si vuole realizzare un'applicazione che risolva
                    due problemi matematici
                    utilizzando la funzione sqrt.
                    Per evidenziare i vantaggi della
                    programmazione concorrente, supporremo
                    che il calcolo della radice quadrata di un numero
                    sia un'operazione onerosa che richiede un tempo di
                    elaborazione di 50 ms (nel codice si aggiungano
                    opportuni ritardi per simulare il maggiore costo
                    computazionale delle istruzioni contenenti una radice quadrata).
                    L'applicazione deve richiedere
                    l'inserimento da tastiera di due numeri interi
                    A, B positivi (si controlli la validità dei dati immessi) e
                    successivamente eseguire le seguenti attività:
                    ◦ Determinare le misure dei cateti C1 = 6.53 * A, C2 = 2.85 * B
                    e dell'ipotenusa I di un triangolo
                    rettangolo.
                    ◦ Posto C = - (B + 10), determinare il Δ dell'equazione Ax
                    2
                     + Bx + C = 0 e le corrispondenti soluzioni
                    reali X1 e X2.
                    L'applicazione deve infine riportare su schermo
                    i risultati ottenuti e il tempo totale di elaborazione (per
                    evitare che il ritardo dovuto all'uso della tastiera influisca
                    sulle rilevazioni, si consiglia di avviare il
                    cronometro dopo la lettura dei dati di input).
                    a) Scrivere un progetto RQSequenziale contenente
                    l'applicazione richiesta utilizzando un algoritmo
                    sequenziale.
                    b) Scrivere un progetto RQParallelo contenente la
                    versione concorrente dell'applicazione. Confrontare i
                    tempi ottenuti e calcolare lo speedup.
                    L'output prodotto dai progetti deve rispettare il
                    seguente formato (i lati del triangolo devono essere
                    visualizzati con due cifre decimali, le soluzioni dell'equazione con tre):
                    A: 4
                    B: 5
                    Tempo di elaborazione [ms]: 58
                    Risultati:
                     Triangolo rettangolo di cateti 26,12; 14,25 e ipotenusa 29,75
                     Soluzioni dell'equazione di secondo grado: x1 = -2,660; x2 = 1,410

*/
using System;
// Contiene lo Stopwatch, serve per tenere il tempo
using System.Diagnostics;
// Contiene i tasks, cioè il metodò di paralelismo che utilizzerò
using System.Threading.Tasks;

namespace RadiciQuadrate
{
    class MainClass
    {
        public static void Main(string[] args)
        {
            //// Variabili ////
            // dati in input
            int A,
                B;
            // Problema del triangolo
            double C1,
                  C2,
                  I;
            // Problema Equazione 2 grado
            double C,
                  Delta,
                  X1,
                  X2;
            // Creazione del clock
            Stopwatch cronometro = new Stopwatch();

            //// Richieste in input ////
            // Richiesta di A
            do
            {
                Console.Write("A: ");
                A = Convert.ToInt32(Console.ReadLine());
            // Continua finchè il numero non è positivo
            } while (A < 0);
            // Richiesta di B
            do
            {
                Console.Write("B: ");
                B = Convert.ToInt32(Console.ReadLine());
            // Continua finchè il numero non è positivo
            } while (B < 0);

            //// Elaborazione ////
            /// Inizio del clock
            cronometro.Start();
            /// Problema del triangolo
            // Calcolo i cateti
            C1 = 6.53 * A;
            C2 = 2.85 * B;
            //? Devo mettere un delay ?
            // Calcolo l'ipotenusa
            I = Math.Sqrt(Math.Pow(C1, 2) + Math.Pow(C2, 2));
            /// Problema dell'equazione di 2 grado
            // Calcolo C
            C = -(B + 10);
            // Calcolo il Delta
            Delta = Math.Sqrt(Math.Pow(B, 2) + (-4 * A * C));
            Console.WriteLine(Delta);
            // Calcolo X1 e X2
            X1 = (-B + Delta) / (2 * A);
            X2 = (-B - Delta) / (2 * A);
            
            //// Output
            // Termino il cronometro
            cronometro.Stop();
            // Stampe
            Console.WriteLine("Tempo di elaborazione [ms]: {0}",cronometro.ElapsedMilliseconds);
            Console.WriteLine("Risultati:\n\tTriangolo rettangolo di cateti {0:F2}; {1:F2} e ipotenusa {2:F2}",C1,C2,I);
            Console.Write("\tSoluzioni dell'equazione di secondo grado: x1 = {0:F2}; x2 = {1:F2}", X1, X2);

        }
    }
}
