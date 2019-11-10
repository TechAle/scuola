/*
	Name: minimo2
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

float min(float a, float b)
{
	if ( a > b )
		return b;
	else
		return a;
}

int main()
{
	// Variabili
	float 	a,
			b;
	// Input
	a = rich();
	b = rich();
	// Elaborazine
	printf("Minimo: %f",min(a,b));
}
