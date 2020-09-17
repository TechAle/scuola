/*
	Name: minimo3
	Author: Alessandro Condello
	Date: 21:10:2019
	Description: Scrivere una funzione che, ricevuti in ingresso due numeri
interi, restituisca il valore minimo.
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

float min(float a, float b, float c)
{
	if ( a < b )
		if ( a < c )
			// a minore di tutto
			return a;
		else
			// c minore di tutto
			return c;
	// b minore
	else
		if ( b > c)
			// c minore di tutto
			return c;
		else
			// b minore di tutto
			return b;
}

int main()
{
	// Variabili
	float 	a,
			b,
			c;
	// Input
	a = rich();
	b = rich();
	c = rich()
	// Elaborazine
	printf("Minimo: %f",min(a,b,c));
}
