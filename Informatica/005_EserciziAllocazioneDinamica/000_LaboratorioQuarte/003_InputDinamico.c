/*
	Name: Caricamento dinamico
	Author: Condello Alessandro
	Date: 11/11/19 09:13
	Description: Caricare e stampare un vettore la cui dimensione è scelta in modo dinamico,
*/
#include <stdio.h>
#include <stdlib.h>
int main()
{
	int *p;
	int n,
		i;
	printf("Inserire la dimensione");
	scanf("%d",&n);
	p = (int*) malloc (n*sizeof(int));
	for ( i = 0 ; i < n ; i++)
	{
		printf("%d valore; ",i+1);
		scanf("%d",p+i);
	}
	printf("stampa: ");
	for(i = 0 ; i < n ; i++)
	{
		printf("%d ",*(p+i));
	}
}
