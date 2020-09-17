/*
	Name: Potenza
	Author: Alessandro Condello
	Date: 21:10:2019
	Description: Scrivere una funzione che riceva in ingresso due numeri
interi a e b (b > 0) e restituisca il risultato della potenza a^b.
*/
#include <stdio.h>
#include <math.h>

float rich()
{
	float num;
	printf("Inserire un numero");
	scanf("%f",&num);
	return num;
}

float potenza(float a, float b)
{
	if ( b > 0 )
		return pow(a,b);
	else
		return -1;
}

int main()
{
	// Variabili
	float 	a,
			b,
			ris;
	// Input
	a = rich();
	b = rich();
	// Elaborazine
	ris = potenza(a,b);
	// Output
	if ( ris == -1)
		printf("B deve essere > di 0");
	else
		printf("Risultato: %f",ris);
}
