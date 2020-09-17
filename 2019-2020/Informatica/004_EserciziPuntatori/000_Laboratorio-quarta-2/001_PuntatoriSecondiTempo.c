/*
	Name: Alessandro Condello
	Date: 18/10/19 10:09
	Description: Scrivete una funzione con prototipo void split_time ( long int tot_sec, int *h, int *m, int *s ) che,
				dato un orario fornito in numero di secondi dalla mezzanotte, calcoli l’orario equivalente in ore, minuti, secondi, e lo
				memorizzi nelle tre variabili puntate da (h), (m) e (s) rispettivamente.
*/
#include <stdio.h>
#include <time.h>
#include <stdlib.h>
void split_time ( long int tot_sec, int *h, int *m, int *s )
{
	*h = tot_sec/3600;
	*m = tot_sec%3600/60;
	*s = tot_sec%3600%60;
}
int main()
{
	int ore,
		minuti,
		secondi;
	long int tot_sec;
	
	srand(time(NULL));
	tot_sec = rand();
	split_time(tot_sec, &ore, &minuti, &secondi);
	printf("Secondi totali: %ld\nOre: %d\nMinuti: %d\nSecondi: %d",tot_sec,ore,minuti,secondi);
}
