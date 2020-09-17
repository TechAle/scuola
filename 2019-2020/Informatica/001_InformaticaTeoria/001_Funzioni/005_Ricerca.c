/*
	Name: Funzione ricerca
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: Scrivere una funzione per calcolare la media
*/
#include <stdio.h>
#include <time.h>
#include <stdlib.h>
#define N 5
void rich(int vet[],int len)
{
	int i;
	for(i = 0; i < len ; i++)
	{
		vet[i] = rand()%10;
	}
}
void stampa(int vet[], int len)
{
	int i;
	for( i = 0 ; i < len ; i++ )
		printf("Numero 1: %d\n",vet[i]);
}

int ricerca(int len, int x, int vet[])
{
	int i = 0,
		trov = 0;
	do
	{
		if ( vet[i] == x )
			trov++;
		else
			i++;
	}while(i < len && !trov);
	if(trov)
		return i;
	else
		return -1;
}

int main()
{
	srand(time(NULL));
	int vet[N],
		x,
		ris;
	rich(vet, N);
	stampa(vet, N);
	printf("Incognita: ");
	scanf("%d",&x);
	ris = ricerca(N,x,vet);
	if ( ris == -1)
		printf("L'incognita non esiste");
	else
		printf("Incognita trovata");
	
}
