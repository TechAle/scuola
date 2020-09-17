/*
	Name: ricerca
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Dato un vettore di numeri determinare la posizione di un
	determinato numero x.
*/
#include <stdio.h>
#define N 4
int main()
{
	// variables //
	int i,
		vet[N],
		x,
		fin;
	// input vet //
	for(i=0;i<N;i++)
	{
		printf("inserire %d valore ",i+1);
		scanf("%d",&vet[i]);
	}
	// input incognite value
	printf("inserire il valore incognito ");
	scanf("%d",&x);
	// searching
	i = fin = 0;
	do
	{
		if(vet[i]!=x)
			i++;
		else
			fin = 1;
	}while(i<N && !fin);
	// output
	if(fin)
		printf("valore trovato");
	else
		printf("valore non trovato");
}

