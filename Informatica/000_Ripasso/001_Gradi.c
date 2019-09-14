/*
	Name: Gradi
	Auture: Condello Alessandro
	Date: 13/09/19 10:12
	Description: 1.	Scrivere un programma che, data in input la misura di un angolo in gradi 
	(G), primi (P), secondi (S), determini la sua ampiezza in secondi.
*/
#include <stdio.h>
int main()
{
	// variables //
	int gradi,
		primi,
		secondi;
	// input //
	printf("inserire gradi, primi, secondi");
	scanf("%d%d%d",&gradi,&primi,&secondi)
	/// output
	// secondi + 1 grado is 3600 secondi, 1 primi is 60 secondi
	printf("secondi: %d",secondi+gradi*3600+primi*60)
	
}
