/*
	Name: Ricerca di un elemento in vettore
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: Si scriva una funzione in C, denominata iniziali, che valuti quanti caratteri iniziali sono in comune tra due stringhe date. 
				Le stringhe sono globali. La funzione restituisce il numero intero. 
				Ad esempio:  • se la funzione venisse chiamata come iniziali ("ciao", "cielo"), 
				dovrebbe restituire 2 in quanto i primi due caratteri sono identici.  
				• se la funzione venisse chiamata come iniziali ("ciao", "salve"), 
				dovrebbe restituire 0 in quanto nessun carattere iniziale è in comune
*/
#include <stdio.h>
#include <string.h>
#define N 10

int confr(char stringa1[], char stringa2[]);

int confr(char stringa1[], char stringa2[])
{
	int i,
		cont = 0;
	for( i = 0 ; i < strlen(stringa1) ; i++)
	{
		if ( stringa1[i] == stringa2[i])
			cont++;
	}
	return cont;	
} 

int main()
{
	char stringa[2][N];
	int i;
	
	for( i = 0 ; i < 2 ; i++)
	{
		printf("%d Stringa: ",i+1);
		gets(stringa[i]);
	}
	printf("Caratteri uguali: %d",confr(stringa[0],stringa[1]));
}
