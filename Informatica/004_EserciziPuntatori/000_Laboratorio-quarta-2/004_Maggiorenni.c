/*
	Name: Maggiorenni
	Author: Condello Alessandro
	Date: 25/10/19 10:12
	Description: Dato un elenco, contare i maggiorenni
*/
#define N 20
#include <stdio.h>
#include <stdlib.h>
#include <time.h>
void rich(int *vet)
{
	srand(time(NULL));
	int i;
	for ( i = 0 ; i < N ; i++ )
		vet[i] = rand()%30;
	
}

int maggiorenni(int *vet)
{
	int cont = 0;
	int i;
	for ( i = 0 ; i < N  ; i++)
		if ( vet[i] > 17 )
			cont++;
	return cont;
}

int main()
{
	// Variabili
	int eta[N];
	// Input
	rich(eta);
	printf("n maggiorenni: %d",maggiorenni(eta));
	
}

