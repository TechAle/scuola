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
			int i;
			// input
			Console.Write("inserire quante coppia si vogliano");
			// for + input
			for(i=0;i<Convert.ToInt32(Console.ReadLine());i++)
			{
				// input numbers
				Console.WriteLine("inserire {0} coppia", i + 1);
				string[] coppia = Console.ReadLine().Split();
				// output
				Console.WriteLine("somma della {0} coppia: {1}", i + 1, Convert.ToInt32(coppia[1]) + Convert.ToInt32(coppia[0]));
			}
			
		}
	}
}