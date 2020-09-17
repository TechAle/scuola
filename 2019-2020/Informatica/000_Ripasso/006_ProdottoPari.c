/*
	Name: prodotto pari
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Dato un vettore di interi calcolare il prodotto di tutti i numeri pari.
*/
#include <stdio.h>
#define N 5
int main()
{
	// variables //
	int i,
		vet[N],
		somm;	
	// input vet //
	somm = 0;
	for(i=0;i<N;i++)
	{
		printf("inserire %d numero",i+1);
		scanf("%d",&vet[i]);
		if(vet[i]%2 == 0 && vet[i] != 0)
			if(somm == 0)
				somm = vet[i];
			else
				somm*=vet[i];
	}
	// output addiction of all even numbers
	printf("somma: %d",somm);
}
