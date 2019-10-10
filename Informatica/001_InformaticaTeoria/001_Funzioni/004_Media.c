/*
	Name: Funzione della media
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: Scrivere una funzione per calcolare la media
*/
#include <stdio.h>
#include <time.h>
#include <stdlib.h>

void rich(int vet[],int len)
{
	int i;
	for(i = 0; i < len ; i++)
	{
		vet[i] = rand()%10;
	}
}
float media(int vet[], int len)
{
	int somma = 0;
	int i;
	for ( i = 0 ; i < len ; i++ )
		somma += vet[i];
	return (float) somma / (float) len;
}


#define N 5
int main()
{
	int vet[N];
	srand(time(NULL));
	rich(vet,N);
	printf("Media: %f",media(vet,N));
}
