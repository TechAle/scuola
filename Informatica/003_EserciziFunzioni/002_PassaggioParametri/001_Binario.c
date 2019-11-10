/*
	Name: Funzione Binario
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: scrivere una funzione che legge un numero binario da tastiera e lo stampa in
binario
*/
#include <stdio.h>
#include <stdlib.h>
#include <time.h>

void rich(char frase[])
{
	printf("Inserire un numero binario");
	gets(frase);
}

void stampa(char frase[])
{
	printf("Binario: %s",frase);
}

int main()
{
	// Variabili
	char frase;
	// Input
	rich(frase);
	// Output
	stampa(frase);
}
