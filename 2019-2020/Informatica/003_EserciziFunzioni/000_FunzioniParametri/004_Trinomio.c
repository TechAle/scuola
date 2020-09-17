/*
	Name: Trinomio
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: Scrivere un programma che ricevuti in ingresso i tre parametri a, b e c di un trinomio di secondo grado del tipo: ax2+bx+c=0 
	Utilizzi una funzione per il calcolo delle soluzioni del trinomio dato passando alla funzione i tre parametri a, b e c per valore. 
*/
#include <stdio.h>
#include <math.h>
// Dichiarazione funzioni
float soluzioneTrin(float a, float b, float c, int sol);
// Funzioni
float soluzioneTrin(float a, float b, float c, int sol)
{
	float delta = -4*a*b;
	if sol == 0
}
// Main
int main(void)
{
	// Variabili
	float a, b, c;
	// Input
	printf("a, b, c: ");
	scanf("%f%f%f",&a,&b,&c);
	// output
	printf("Soluzione 1: %f\nSoluzione 2: %f",soluzioneTrin(a,b,c,0),soluzioneTrin(a,b,c,1))
}
