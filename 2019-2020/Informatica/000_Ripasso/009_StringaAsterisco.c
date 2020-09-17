/*
	Name: ricerca
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: 9.	Sostituire ogni cifra numerica contenuta in una stringa 
	con il carattere *. Stampare il risultato ottenuto
*/
#include <stdio.h>
#include <string.h>
#include <ctype.h>
#define MAX 15
int main()
{
	// variables //
	char stringa[MAX];
	int i;
	// input string //
	printf("inserire la stringa ");
	gets(stringa);
	// analizy
	for(i=0;i<strlen(stringa);i++)
		if(isdigit(stringa[i]))
			stringa[i] = 'x';
	// output
	printf("stringa: ");
	puts(stringa);
}
