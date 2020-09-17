/*
	Name: Somma quadrati
	Author: Alessandro Condello
	Date: 16/09/19 08:18
	Description: Dati N numeri calcolare la somma dei loro quadrati.
*/
#include <stdio.h>
#include <math.h>
#define MAX 5
int main()
{
	// variables //
	int N,
		somma,
		temp,
		i;
	
	printf("inserire la quantità di numeri");
	scanf("%d",&N);
	
	// check if is ok
	if(N>0 && N<MAX)
	{
		somma = 0;
		for(i=0;i<N;i++)
		{
			printf("inserire %d numero ",i+1);
			scanf("%d",&temp);
			somma += pow(temp,2);
		}
		printf("somma quadrati: %d",somma);
	}
	else
		printf("la quantità di numeri non segue i requisiti adatti");
}
