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

float somma(float n1, float n2)
{
	return n1+n2;
}

float sottrazione(float n1, float n2)
{
	return n1-n2;
}

float prodotto(float n1, float n2)
{
	return n1*n2;
}

float divisione(float n1, float n2)
{
	return n1/n2;
}

float quoziente(float n1, float n2)
{
	return n1/n2;
}

int main()
{
	// Variabili
	float 	n1,
			n2;
	// Input
	n1 = rich();
	n2 = rich();
	// Output
	printf("Somma: %f\n",somma(n1,n2));
	printf("Sottrazione: %f\n",sottrazione(n1,n2));
	printf("Prodotto: %f\n",prodotto(n1,n2));
	printf("Divisione: %f\n",divisione(n1,n2));
	printf("Resto: %f\n",quoziente(n1,n2));
}
