/*
	Name: Area massima
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: 5.	Dato un vettore contenente i raggi di n circonferenze, 
	determinare il cerchio di area massima.
*/
#include <stdio.h>
#include <math.h>
#define MAX 4
int main()
{
	// variables //
	int N,
		raggio[MAX],
		i,
		max;
	float cinc;
	// input //
	printf("inserire la quantita di numeri");
	scanf("%d",&N);
	
	// check if is ok
	if(N>0 && N<MAX)
	{
		for(i=0;i<N;i++)
		{
			// input radius
			printf("inserire il %d raggio ",i+1);
			scanf("%d",&raggio[i]);
			// make max
			if(i==0)
				max = raggio[0];
			else
				// check if is the max
				if(max < raggio[i])
					max = raggio[i];
		}
		printf("%d",max);
		// print the Circumference
		cinc = pow(max,2)*M_PI;
		
		printf("la circonferenza massime e %f",cinc);
	}
	else
		printf("number cannot be used");
}
