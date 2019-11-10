/*
	Name: Funzione operazioni
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: scrivere una funzione che legge due numeri acquisiti da tastiera e stampa,
usando le funzioni: la somma, il prodotto, la differenza e il quoziente
*/
#include <stdio.h>
#include <stdlib.h>
#include <time.h>

float rich()
{
	float num;
	printf("Inserire un numero");
	scanf("%f",&num);
	return num;
}

int pari(float n1)
{
	if ( n1%2 == 0)
		return 1;
	else
		return 0;
}


int main()
{
	// Variabili
	float 	n1;
	// Input
	n1 = rich();
	// Output
	if (pari(n1))
		printf("Il numero e pari");
	else
		printf("Il numero e dispari");
}
