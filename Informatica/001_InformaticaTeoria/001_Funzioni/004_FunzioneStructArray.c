/*
	Name: FunzioniStruct
	Author: Alessandro Condello
	Date: 01/10/19 08:44
	Description: Fare un passaggio di un vettori du struct e stamparlo
*/
#include <stdio.h>
#define N 2

struct persona
{
	char nome[20];
	int eta;	
};

void rich(struct persona per[], int len_);
void stampa(struct persona per[], int len);

void rich(struct persona per[], int len)
{
	int i;
	for(i = 0; i < len ; i++)
	{
		printf("%d nome: ",i+1);
		scanf("%s",per[i].nome);
		printf("%d eta: ",i+1);
		scanf("%d",&per[i].eta);
	}
}

void stampa(struct persona per[], int len)
{
	int i;
	for(i = 0 ; i < len ; i++)
		printf("persona\t%d:\nnome\t%s\neta\t%d\n",i+1,per[i].nome,per[i].eta);
}

int main()
{
	// Variabili
	struct persona per[N];
	rich(per, N);
	stampa(per, N);
	
}
