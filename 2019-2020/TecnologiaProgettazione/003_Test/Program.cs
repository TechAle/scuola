using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Test
{
    class Program
    {
        static void Main(string[] args)
        {

            ///// set variables /////
            int intero = 55;
            float fp = 12.5F;
            string stringa = "Ciao";
            // getting input
            Console.WriteLine("inserire un intero");
            int intero2 = Convert.ToInt32(Console.ReadLine());
            // printing variables
            Console.WriteLine("Intero: {0},\nfloat: {1},\nstringa: {2}", intero, fp, stringa);
            fp = Convert.ToSingle(Console.ReadLine());
            Console.Write("second float: {0}", fp);
            // for keep console open until pressing key
            Console.ReadKey();
        }
    }
}
