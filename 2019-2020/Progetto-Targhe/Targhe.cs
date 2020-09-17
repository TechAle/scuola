/*
 *	Autore: Condello Alessandro
 *  Progetto: Ricerca di tot targhe in un file
 */
using System;
using System.IO;
using System.Text;
using System.Linq;

namespace targhe
{

    public static class Dizionario
    {
        // Dizionario di nomi casuali
        public static readonly string[] parole = { "prova", "macchina", "ciao", "a9a", "aaaa", "ab90ab", "90ba" };
        // Dizionario di tutte le targhe
        public static readonly string[] targhe =
        {
            // Italia - Croazia - Francia
            "AA000AA",
            // Austria - Grecia - Lettonia - Malta
            "AAA0000",
            // Belgio
            "0AAA001",
            // Bulgaria (diviso in 2)
            "A0000AA",
            "AA0000AA",
            // Cipro - lituania - Svezia - Ungheria
            "AAA00",
            // Danimarca
            "AA00000",
            // Lussemburgo - Paesi bassi
            "AA0000",
            // Irlanda
            "000A00000",
            // Polonia - Portogallo
            "AAA00AA",
            // Solvenia
            "AAAA000"
        };
        public static readonly string[] citta =
        {
            "Italia - Croazia - Francia",
            "Austria - Grecia - Lettonia - Malta",
            "belgio",
            "Bulgaria",
            "bulgaria",
            "Cipro - Lituania - Svezia - Ungheria",
            "Danimarca",
            "Lussemburgo - Paesi bassi",
            "Irlanda",
            "Polonia - Portogallo",
            "Slovenia"
        };
    }

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
						CreateFile.MainFile();
						break;
                    // Ricerca della targa
					case 2:
                        RicercaFile.MainRicercaFile();
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
    class RicercaFile
    {
        public static void MainRicercaFile()
        {
            // Controllo se il file esiste
            if (File.Exists("testo.txt"))
            {
                // Aprimento file
                using (var streamReader = new StreamReader("testo.txt", Encoding.UTF8))
                {
                    // Estrapolazione del testo del file e diviso per spazi
                    string[] text = streamReader.ReadToEnd().Split();
                    // Analisi di tutti gli elementi
                    foreach (string frase in text)
                    {
                        int ris = ControlloTag(frase);
                        // Se risulta > 0 e cioè è stato trovato, allora che stampi
                        if ( ris > 0 )
                        {
                            ris -= 1;
                            Console.WriteLine("Targa: {0} Possibile provenienza {1}", frase, Dizionario.citta[ris]);
                        }
                    }
                        
                    
                    
                }
            }
        }
        public static int ControlloTag(string nome)
        {
            /*
             *  Controllo della lunghezza:
             *  Prima di tutto si controlla la lunghezza ( deve essere compresa tra 5 e 8 )
             *  Poi si và ad esclusione:
             *  Si controlla lettere per lettera.
             *  Esempio perfetto:
             *  FD931LA
             *  AA000AA
             *  Se ci stà la A si controlla se ci stà una lettera,
             *  Se ci sta lo 0 si controlla se ci stà un numero.
             *  Si continua a controllare finchè o si sono escluse tutte le opzioni
             *  oppure la frase è finita e perciò l'unica opzione rimanente è quella giusta
             */

            // Controllo lunghezza
            if (nome.Length > 4 && nome.Length < 9)
            {
                // Si crea un vettore con valori da 0 fino alla lunghezza della lista delle tag
                // Serve per poi fare l'esclusione ( Utilizzo delle list comprehensions )
                int[] listaTarghe = Enumerable.Range(0,Dizionario.targhe.Length-1).ToArray();
                // Controllo ogni lunghezza
                foreach (int indice in listaTarghe)
                    // Se le lunghezze sono diverse
                    if (Dizionario.targhe[indice].Length != nome.Length)
                        // Prendi tutti i valori tranne l'indice
                        listaTarghe = listaTarghe.Where(val => val != indice).ToArray();
                // Indice per scorrere l'array
                int i = 0;
                do
                {

                    foreach (int j in listaTarghe)
                        // Controllo ciò che bisogna vedere è un numero
                        if (Dizionario.targhe[j][i] == '0')
                        // Controllo se la lettera è un numero
                        {
                            if (!IsNumero(nome[i]))
                                listaTarghe = listaTarghe.Where(val => val != j).ToArray();

                        }
                        else

                            // Senò è una lettera
                            if (!IsLettera(nome[i]))
                            listaTarghe = listaTarghe.Where(val => val != j).ToArray();

                    i += 1;


                } while (i < nome.Length && listaTarghe.Length != 0);
                if (listaTarghe.Length == 1)
                    return listaTarghe[0]+1;
                
                // Controllo se ce ne stanno più di 2, se si togliamo quelli non uguali
                if ( listaTarghe.Length > 1 )
                    foreach (int num in listaTarghe)
                    {
                        // Se è uguale allora ritorna vero
                        if (Dizionario.targhe[num].Equals(nome))
                            return num+1;
                    }
                return 0;
            }

            return 0;
        }

        // Controllo se il carattere è un numero
        public static bool IsLettera(char lettera)
        {
            /*
             *  Controllo il codice ascii
             *  Se è compreso tra 65 e 90
             *  allora è una lettera
             */

            if (lettera > 64 && lettera < 91)
                return true;

             return false;
        }

        // Controllo se il carattere è una lettera
        public static bool IsNumero(char lettera)
        {
            /*
             *  Controllo il codice ascii
             *  Se è compreso tra 48 e 57
             *  allora è un numero
             */
            if (lettera > 47 && lettera < 58)
                return true;
            return false;
        }
    }


	// Creazione file
	class CreateFile
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
            // Testo 
            string testo = Casuale();
            for ( int i = 1; i < n_num; i++)
            {
                testo = string.Concat(testo, " ", Casuale());
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

        public static string Casuale()
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
                return Dizionario.parole[rnd.Next(Dizionario.parole.Length)];
            // Targa
            else
                return TargaGen(rnd);


        }

        public static string TargaGen(Random rnd)
        {
            /*
             * ci stanno 10 tipi 
             *
             */
            string stringa = "";
            foreach (var parola in Dizionario.targhe[rnd.Next(Dizionario.targhe.Length)])
            {
                if (parola == 'A')
                    stringa += LettereGen(rnd);
                else
                    stringa += NumeroGen(rnd);
            }
            return stringa;
        }

        public static string LettereGen(Random rnd)
        {
            /*
             * Il codice ascii della A è di 65,
             * Quello della Z è di 90
             * Ritorno una stringa fatta da 2 lettere casuali
             */
            return string.Concat((char)rnd.Next(65, 90));
        }
        // Generazione numero casuale 0-9 e lo ritorni come stringa
        public static string NumeroGen(Random rnd)
        {
            return string.Concat(rnd.Next(10));
        }

	}
}
