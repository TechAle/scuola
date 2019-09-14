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
			int i,
				j;
		    string choose;

			// input
			Console.WriteLine("inserire 3 numberi");
			choose = Console.ReadLine();
			// controll if the list is == 3
			if (choose.Split().Length == 3)
			{
				// take all number and put in the array
				int[] num = { Convert.ToInt32(choose.Split()[0]), Convert.ToInt32(choose.Split()[1]), Convert.ToInt32(choose.Split()[2]) };

				if (!(num[0] == num[1] && num[1] == num[2]))
				{
					// if all number arent the same
					i = 0;
					bool finish = false;
					// check all number until you found 2 that are the same (i’m bored so i write an algorithm that find if there are 2 same number in N number
					while(i<num.Length-1 && !finish)
					{
						j = i + 1;
						// check all the number
						while (j < num.Length && !finish)
						{
							if (num[i] == num[j])
								// if 2 number are the same
								finish = true;
							else
								// else continue
								j++;

						}
						i++;
					}
					if (finish)
						Console.Write("2 numberi sono uguali");
					else
						Console.Write("nessun numero è uguale");

				}else
				{
					Console.Write("tutti i numeri sono uguali");
				}
			}
			else
				Console.Write("la lunghezza della lista non è uguale a 3");



			// for keep console open until key press
			Console.ReadKey();


		}
	}
}