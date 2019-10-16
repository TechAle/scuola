/*
	Name: FunzioniArray
	Author: Alessandro Condello
	Date: 01/10/19 08:44
	Description: Fare un passaggio di array e stampare un array
*/
#include <stdio.h>
#define N 5

void rich(int vet[], int len)
{
	int i;
	for(i = 0; i < len ; i++)
	{
		printf("%d valore: ",i+1);
		scanf("%d",&vet[i]);
	}
}

void stampa(int vet[], int len)
{
	int i;
	for(i = 0 ; i < len ; i++)
		printf("Valore %d: %d\n",i+1,vet[i]);
}

int main()
{
	// Variabili
	int vet[N];
	rich(vet, N);
	stampa(vet, N);
	
}
