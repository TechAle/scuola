/*
	Name: ricerca
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Letto in input un array A di n interi, costruire un array B 
	con gli stessi elementi di A, ma memorizzati al contrario 
	(il primo elemento di A è l'ultimo elemento di B, 
	l'ultimo elemento di A è il primo di B). Stampare il vettore B.
*/
#include <stdio.h>
#include <string.h>
#include <ctype.h>
#define N 5
int main()
{
	// variables //
	int N1[N],
		N2[N],
		i;
	// input //
	for(i=0;i<N;i++)
	{
		printf("inserire %d input ",i+1);
		scanf("%d",&N1[i]);
	}
}
