/*
	Name: Funzione tempo
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: Scrivere un programma che da dato un tempo calcoli il suo in secondi
*/
#include <stdio.h>
#include <stdlib.h>
#include <time.h>

void rich(int vet[],int len)
{
	int i;
	srand(time(NULL));
	for(i = 0; i < len ; i++)
	{
		// ore
		if ( i == 2)
			vet[i] = rand()%60;
		// secondi
		else
			vet[i] = rand()%24;
	}
}

void stampa(int vet[], int len)
{
	int i;
	for( i = 0 ; i < len ; i++ )
		printf("Numero 1: %d\n",vet[i]);
}

int secondi(int ore, int minuti, int secondi)
{
	return (ore*3600+minuti*60+secondi);
}

int main(void)
{
	int orario[3];
	
	rich(orario, 3);
	printf("ore\t%d\nminuti\t%d\nsecondi\t%d\n",orario[0],orario[1],orario[2]);
	printf("Secondo: %d",secondi(orario[0],orario[1],orario[2]));
}
