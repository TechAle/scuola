/*
	Name: media positiva
	Auture: Condello Alessandro
	Date: 13/09/19 10:23
	Description: 3.	Dati n numeri interi positivi calcolare la media aritmetica 
	di quelli compresi tra x ed y.

*/
#include <stdio.h>
#define MAX 10
int main()
{
	/// variables ///
	int scelta[2],
		i,
		ok;
	int somma;
	
	// inputs //
	printf("inserire il minimo e massimo ");
	scanf("%d%d",&scelta[0],&scelta[1]);
	// check if are positive
	ok = somma = 0;
	for(i=0;i<2;i++)
		if(scelta[i]<0 && !ok)
			{
				ok = 1;
				printf("%d is negative",scelta[i]);
			}
	// loop for aritmetic
	for(i=scelta[0];i<=scelta[1];i++)
		somma += i;

	// output
	printf("addition: %d",somma);
	
}
