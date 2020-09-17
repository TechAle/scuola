/*
	Name: Esercizio 1
	Author: Alessandro Condello
	Date: 22:10:2019
	Description: Scrivere un programma C che definisca la struttura “esame”, 
	composta dal nome dell’esame (stringa) e dal
	voto (intero). Si leggano poi da terminale
	• 1 esame e lo si stampi. Si contino e stampino le vocali minuscole del nome
	• n esami, con n definito dall’utente (max 30), e si inseriscano in un array. L’utente inserisca poi il
	nome di un esame da cercare e si stampi il relativo voto, se l'esame è presente.
*/
#include <stdio.h>
#include <string.h>
#include <ctype.h>
struct esameS
{
	char nome[20];
	int voto;
};

void rich(struct esameS *esame)
{
	printf("Nome: ");
	gets((*esame).nome);
	printf("Voto: ");
	scanf("%d",&(*esame).voto);
}

int conta(char nome[])
{
	int i;
	int cont = 0;
	for ( i = 0 ; i < strlen(nome) ; i++ )
	{
		if ( islower(nome[i]))
		{
			printf("%c ",nome[i]);
			cont++;
		}
	}
	return cont;
}
#define N 30
int main()
{
	struct esameS esame1,
		   		   esami[N];
	int quantita,
		i;
	char nomeEx[20];
	
	// Richieste
	rich(&esame1);
	quantita = conta(esame1.nome);
	printf("N^ minuscole %d\n",quantita);
	// Vettore
	printf("N esami: ");
	scanf("%d",&quantita);
	getchar();
	// Richieste
	for ( i = 0 ; i < quantita ; i ++)
	{
		rich(&esami[i]);
		getchar();
	}
	// Ricerca
	printf("Nome cercare: ");
	gets(nomeEx);
	i = 0;
	do
	{
		if ( strcmp(esami[i].nome, nomeEx) == 0)
			i = -2;
		i += 1;
	}while ( i < quantita && i != -1);
	if ( i == -1 )
		printf("Trovato");
	else
		printf("Non trovato");
}



















