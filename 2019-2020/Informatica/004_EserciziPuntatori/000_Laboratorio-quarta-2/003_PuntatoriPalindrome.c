/*
	Name: Alessandro Condello
	Date: 18/10/19 10:19
	Description: Controllare se una parola è palindroma con i puntatori
*/
#include <stdio.h>
#include <string.h>
#include <math.h>
int palindroma( char parola[10], int *contatore)
{
	// Prendo la meta
	int inizio = round(strlen(parola)/2);
	char meta[inizio];
	// Porto la prima parte in una stringa
	for ( *contatore = 0 ; *contatore < inizio; *contatore++)
		meta[*contatore] = parola[*contatore];
	// Controllo se la lunghezza è dispari ( aadaa )
	if ( strlen(parola)%2 != 0 )
		inizio++;
	
	printf("%c a",parola[1]);
	*(contatore) = 1;
	printf("%c a",parola[1]);
	int i = 0;
	while ( *contatore > round(strlen(parola)) )
	{
		if ( meta[i] != parola[*contatore])
			return -1;
		*contatore++;
	}
	return 1;
}

int main()
{
	char parola[10];
	int contatore;
	strcpy(parola, "ccdca");
	printf("%d",palindroma(parola, &contatore));
}
