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
			Console.Write("inserire quante volte potenzie si vogliono fare ");
			int choose = Convert.ToInt32(Console.ReadLine());
			// check if is <2 and >14
			if (choose >= 2 && choose <= 14)
				// cicle
				for (i = 2; i <= choose; i++)
					// print pow
					Console.WriteLine("2^{0} == {1}", i, Math.Pow(2,i));

			else
				// if it isnt
				Console.Write("il numbero non rispetta i requisiti necessari");

			
		}
	}
}