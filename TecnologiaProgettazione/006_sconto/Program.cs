using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Media
{
	class Program
	{
		static void Main(string[] args)
		{
			/// Variables
			int sconto = 0;
			// input
			Console.Write("inserire il costo totale ");
			float choose = Convert.ToInt32(Console.ReadLine());
			// check
			if (choose >= 100 && choose < 300)
				sconto = 5;
			else if (sconto >= 300)
				sconto = 10;
			// print 
			Console.Write("prezzo finale: {0}", choose - choose * sconto / 100);

			
		}
	}
}