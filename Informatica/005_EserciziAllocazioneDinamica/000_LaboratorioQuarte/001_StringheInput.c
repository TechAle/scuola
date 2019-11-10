/*
	Name: Input Stringa Dinamica
	Author: Condello Alessandro
	Date: 08/11/19 10:05
	Description: Data una fuzione, ritornare una stringa data dalla
				 concatazione di 2 stringhe.
				 la stringa di ritorno deve essere dinamicamente
*/
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

void input(char *str)
{
	char string1[10];
	char string2[10];
	printf("Stringa1: ");
	gets(string1);
	printf("Stringa2: ");
	gets(string2);
	strcpy(str, strcat(string1,string2));
}

int main()
{
	char *str;
	str = (char*) malloc(20*sizeof(char));
	input(str);
	puts(str);
	free(str);
}

