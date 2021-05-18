using System;
using web_db_consumer.ServiceReference1; // aggiungere
using System.Data;   // aggiungere

namespace web_db_consumer
{
    class Program
    {
        static void Main(string[] args)
        {
            int scelta;
            WebService1SoapClient service = new WebService1SoapClient();
            do
            {
                Console.Write("Menu:\n1 - Carica DB\n2 - Interroga DB\n3 - Esci\nScelta: ");
                scelta = Convert.ToInt32(Console.ReadLine());
                Console.WriteLine();
                switch (scelta)
                {
                    case 1:
                        carica_database(service);
                        break;
                    case 2:
                        interroga_database(service);
                        break;
                    case 3:
                        break;
                    default:
                        Console.WriteLine("Errore, scelta errata");
                        break;
                }
                Console.WriteLine("Premere un tasto per continuare");
                Console.ReadKey();
                Console.Clear();
            } while (scelta != 3);
        }
        static void carica_database(WebService1SoapClient service)
        {
            /* ottiene il numero di righe totali della tabella, in modo da
                 incrementare alla riga successiva la chiave ID  */
            int ID = service.InterrogaDB().Tables[0].Rows.Count;
            ID++;
            Console.Write("Inserire Cognome: ");
            string cognome = Console.ReadLine();
            Console.Write("Inserire Nome: ");
            string nome = Console.ReadLine();
            if (cognome.Equals("") || nome.Equals(""))
                return;
            service.CaricaDB(ID, cognome, nome);
        }
        static void interroga_database(WebService1SoapClient service)
        {
            int i;
            string[] array_s = { "ID:", "Cognome:", "Nome:" };
            var data_set = service.InterrogaDB();
            foreach (DataTable t in data_set.Tables)    // scorre il database corrente
                /*  scorre le righe della tabella corrente 
                      (t.Rows contiene il numero di righe della tabella)  */
                foreach (DataRow r in t.Rows)    
                {
                    i = 0;
                    /*  scorre i campi della riga corrente
                          (ItemArray contiene i valori dei campi della tabella  */
                    foreach (object o in r.ItemArray)     
                    {
                        Console.WriteLine(array_s[i] + " " + o.ToString());
                        i++;
                    }
                    Console.WriteLine();
                }
        }

    }
}
