/*
	Name: Ricerca di un elemento in vettore
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: Si scriva una funzione in C, denominata alltoupper, che converta in maiuscolo tutti i caratteri della stringa. 
				 In pratica, si tratta della versione “potenziata” della funzione di libreria toupper, 
				 la quale però agisce solo su un singolo carattere. La stringa è globa
*/
#include <stdio.h>
#include <ctype.h>
#include <string.h>
char stringa[10];

void upper()
{
	int i;
	for(i = 0 ; i < strlen(stringa) ; i++ )
	{
		stringa[i] = toupper(stringa[i]);
	}
}


int main()
{
	printf("Stringa: ");
	gets(stringa);
	upper();
	printf("Stringa maiuscola: %s",stringa);
	
}
