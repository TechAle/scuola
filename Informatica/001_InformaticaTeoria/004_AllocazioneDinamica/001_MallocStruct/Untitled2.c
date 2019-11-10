/*
	Name: Malloc Struct
	Author: Condello Alessandro
	Date: 07/11/19 09:09
*/
#include <stdio.h>
#include <stdlib.h>

struct persona
{
	int eta;
	char nome[20];
};

void carica(struct persona *pers, int len)
{
	int i;
	for ( i = 0 ; i < len ; i++ )
	{
		printf("Nome: ");
		gets(pers[i].nome);
	}
	for ( i = 0 ; i < len ; i++ )
	{
		printf("Eta: ");
		scanf("%d",&pers[i].eta);
	}
}

int main()
{
	int n = 4,
		i;
	struct persona *p;
	p = (struct persona *) malloc (n * sizeof(struct persona));
	carica(p,n);
	for(i = 0 ; i < n ; i++)
		printf("%s %d\n",p[i].nome, p[i].eta);
	free(p);
}

