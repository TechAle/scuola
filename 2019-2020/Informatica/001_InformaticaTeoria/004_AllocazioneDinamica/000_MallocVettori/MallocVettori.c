/*
	Name: Malloc
	Author: Condello Alessandro
	Date: 07/11/19 09:09
*/
#include <stdio.h>
#include <stdlib.h>

void carica(int *val, int len)
{
	*val = 1;
	*(val+1) = 5;
	val[2] = 4;
}

int main()
{
	int *p,
		 n = 4,
		 i;
	p = (int*) malloc (n*sizeof(int));
	
	carica(p, n);
	printf("%d %d %d",*p, *(p+1), p[2]);
	free(p);
}

