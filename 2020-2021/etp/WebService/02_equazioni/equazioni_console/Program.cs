using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace equazioni_console
{
    class Program
    {
        static void Main(string[] args)
        {
            equazioni_servizio.equazioni_servizioSoapClient  servizio = new equazioni_servizio.equazioni_servizioSoapClient();
            Console.Write("Inserire a: ");
            Double a = double.Parse(Console.ReadLine());
            Console.Write("Inserire b: ");
            Double b = double.Parse(Console.ReadLine());
            Console.Write("Inserire c: ");
            Double c = double.Parse(Console.ReadLine());
            Console.WriteLine("Risultato: " + servizio.equazione(a, b, c));
            Console.ReadLine();
        }
    }
}
