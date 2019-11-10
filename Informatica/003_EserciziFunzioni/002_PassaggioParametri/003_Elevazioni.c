/*
	Name: Funzione tempo
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: scrivere una funzione che dati due numeri interi x e y calcoli x2+y2 e x2*y con
due funzioni.
*/
#include <stdio.h>
#include <stdlib.h>
#include <time.h>

float rich()
{
	printf("Inserire un numero");
	scanf("%f",&num);
	return num;
}

float quadrato(float x, float y)
{
	return x*x+y*y;
}

float quadratomolt(float x, float y)
{
	return x*x*y;
}

int main()
{
	// Variabili
	float 	x,
			y;
	// Input
	x = rich();
	y = rich();
	// Output
	printf("x^2+y^2 = %f",quadrato(x,y));
	printf("x^2*y = %f",quadratomolt(x,y));
}
