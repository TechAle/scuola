/*
	Name: Funzioni 1
	Author: Alessandro Condello
	Date: 01/10/19 08:44
	Description: Creare 2 funzioni void: una fà la moltiplicazioni e l'altra le divisioni
*/
#include <stdio.h>
// Dichiarazione Funzioni
void moltiplica(float n1,float n2);
void dividi(float n1,float n2);
// Funzioni
void moltiplica(float n1, float n2)
{
	printf("moltiplicazione: %f\n",n1*n2);
}
void dividi(float n1, float n2)
{
	printf("divisione: %f",n1/n2);
}
// Main
int main()
{
	/// Variabili
	float n1 = 4,
		n2 = 2;
	moltiplica(n1,n2);
	dividi(n1,n2);
}

