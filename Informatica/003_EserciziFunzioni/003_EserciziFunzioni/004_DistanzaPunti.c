/*
	Name: minimo2
	Author: Alessandro Condello
	Date: 21:10:2019
	Description: Scrivere una funzione che riceva in ingresso le coordinate x,
y di due punti del piano cartesiano e restituisca la loro distanza. Scrivere
successivamente un programma che richieda in input le coordinate di un
punto A e ne visualizzi la distanza dal punto B (5, 3) utilizzando la funzione
indicata.
*/
#include <stdio.h>
#include <math.h>

void rich(float vet[])
{
	printf("x: ");
	scanf("%f",vet[0]);
	printf("y: ");
	scanf("%f",vet[1]);
}

float distanza(float p1[], float p2[])
{
	return (sqrt( pow(p2[0]-p1[0],2) + pow(p2[1]-p1[1],2) ));
}

int main()
{
	// Variabili
	float a[2],
		  b[2];
	// Input
	rich(a);
	rich(b);
	
}
