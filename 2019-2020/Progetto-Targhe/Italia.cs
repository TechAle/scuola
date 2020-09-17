/*
 *	Autore: Condello Alessandro
 *  Progetto: Ricerca di tot targhe in un file
 */
using System;
using System.IO;
using System.Text;

namespace targhe
{
	class MainClass
	{
		// Main -> Gestore
		public static void Main(string[] args)
		{
			// Variabili
			short app;

			// Loop fino all'uscita
			do
			{
				// Richiesta
				Console.Write("1) Crea file\n2) Ricerca delle targhe\n3) esci\nScelta: ");
				app = Convert.ToInt16(Console.ReadLine());

				// Analisi app
				switch (app)
				{
                    // Creazione del file
					case 1:
						createFile.MainFile();
						break;
                    // Ricerca della targa
					case 2:
                        ricercaFile.mainRicercaFile();
						break;
                    // Uscita
					case 3:
                        Console.WriteLine("Uscita dal programma");
						break;
					// Scelta non disponibile
					default:
						Console.WriteLine("Scelta non disponibile.");
						break;
				}

				// Fine
			} while (app != 3);

		}
	}

    // Ricerca nel file
    class ricercaFile
    {
        public static void mainRicercaFile()
        {
            // Controllo se il file esiste
            if (File.Exists("testo.txt"))
            {
                // Aprimento file
                using (var streamReader = new StreamReader("testo.txt", Encoding.UTF8))
                {
                    // Conteggio dei tag
                    string[] Targhe_;
                    // Estrapolazione del testo del file e diviso per spazi
                    string[] text = streamReader.ReadToEnd().Split();
                    // Analisi di tutti gli elementi
                    foreach (string frase in text)
                        if (controlloTag(frase) == 1)
                            Console.WriteLine(frase);
                    // Stampa della quantità di tag
                    
                    
                }
            }
        }
        public static Int16 controlloTag(string nome)
        {
            /*
             * Una targa italiana è composta da
             * 2 lettere - 3 numeri - 2 lettere
             * Perciò possiamo prima di tutto controllare
             * la sua lunghezza.
             * Nel caso la lunghezza è uguale a 7,
             * Possiamo proseguire a un altro controllo:
             * Controlliamo 1 per 1 ogni singolo componente,
             * per le lettere e i numeri controlliamo il codice ascii.
             * per i numeri deve essere maggiore uguale a 48 e minore uguale di 57.
             * per le lettere deve essere maggiore uguale a 65 e minore uguale a 90
             */

            // Controllo lunghezza
            if (nome.Length == 7)
            {
                /// Controllo ogni singola parte, se ci stà un errore ritorna 0,
                /// Senò darà 1
                int i = 0;

                do
                {

                    // Controllo se bisogna controllare una lettera ( i primi due e gli ultimi due )
                    if (i < 2 || i > 4)
                    {
                        // Controllo ascii
                        if ((int)nome[i] < 65 || (int)nome[i] > 90)
                        {

                            return 0;
                        }
                    }
                    else
                    {

                        if ((int)nome[i] < 48 || (int)nome[i] > 57)
                        {
                            return 0;
                        }
                    }

                    i += 1;
                } while (i < 7);
                return 1;
            }

            return 0;
        }
    }


	// Creazione file
	class createFile
	{
		public static void MainFile()
		{
            // Variabili
            int n_num;
            // Richiesta
            do
            {
                Console.Write("N parole: ");
                n_num = Convert.ToInt32(Console.ReadLine());
                if (n_num < 1)
                    Console.WriteLine("Numero non disponibile, deve essere maggiore uguale a 1");
            // Continua finchè n è maggiore di 1
            } while (n_num < 1);
            // Creo testo casuale
            // Dizionario di nomi casuali
            string[] dizionario = { "prova", "macchina", "ciao", "a9a", "aaaa", "ab90ab", "90ba"};
            // Testo 
            string testo = casuale(dizionario);
            for ( int i = 1; i < n_num; i++)
            {
                testo = string.Concat(testo, " ", casuale(dizionario));
            }
            // Trasformazione in byte per poi scriverlo nel file
            byte[] text = new UTF8Encoding(true).GetBytes(testo);
            // Se il file esiste
            if ( File.Exists("testo.txt") )
            {
                // Richiesta se si vuole sovrascrivere o aggiungere
                do
                {
                    Console.Write("1) Sovrascrivere il file\n2) Aggiungere al file\n3) Uscita\nScelta: ");
                    n_num = Convert.ToInt32(Console.ReadLine());
                    switch (n_num)
                    {
                        // Sovrascrivere
                        case 1:
                            using (StreamWriter sw = new StreamWriter("testo.txt", false))
                            {
                                sw.Write(testo);
                            }
                            break;
                        // Aggiungere
                        case 2:
                            using (StreamWriter sw = File.AppendText("testo.txt"))
                            {
                                sw.Write(" " + testo);
                            }
                            break;
                        // Uscita
                        case 3:
                            Console.WriteLine("Uscita");
                            break;
                        // Errore
                        default:
                            Console.WriteLine("Numero non disponibile");
                            break;
                    }
                // Continua finchè il numero è valido
                } while (n_num < 1 || n_num > 3);
            // Se il file non esiste
            }else
            // Se il file non esiste e allora lo si crea
            {
                // Creiamo il file
                using (FileStream fs = File.Create("testo.txt"))
                {
                    // Aggiunta del testo nel file
                    fs.Write(text, 0, text.Length);
                }
            }
        }

        public static string casuale(string[] dizionario)
        {
            
            // Generazione seed
            Random rnd = new Random();
            /*
             * Possibilità:
             *  1/3 possibilità numero casuale
             *  1/3 possibilità nome casuale
             *  1/3 possibilità targa casuale
             */
            int nCasuale = rnd.Next(3);
            // Numero casuale
            if (nCasuale == 0)
                return Convert.ToString(rnd.Next());
            // Parola casuale
            else if (nCasuale == 1)
                return dizionario[rnd.Next(dizionario.Length)];
            // Targa
            else
                return targaGen(rnd);


        }

        public static string targaGen(Random rnd)
        {
            /*
             * Si prende a considerazione una targa italina
             * Composta da:
             * 2 lettere | 3 numeri | 2 lettere
             */
            return string.Concat(lettereGen(rnd), Convert.ToString(rnd.Next(100, 1000)), lettereGen(rnd));
        }

        public static string lettereGen(Random rnd)
        {
            /*
             * Il codice ascii della A è di 65,
             * Quello della Z è di 90
             * Ritorno una stringa fatta da 2 lettere casuali
             */
            return string.Concat((char)rnd.Next(65, 90), (char)rnd.Next(65, 90));
        }

	}
}
