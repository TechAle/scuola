/*
	Name: Squadre strutture
	Author: Condello Alessandro
	Date: 29/10/19 09:06
	Description: Si scriva un programma C che definisca una struttura che permetta di 
	contenere una serie di dati (struct squadra) del tipo: nome_squadra (stringa di lunghezza 20) ;  
	codice_squadra (intero);  goal_fatti (intero) ;  goal_subiti (intero) .  
	• Li si memorizzi in un vettore di strutture "squadre";  
	• Stampi a terminale tutti i nomi e codici delle squadre che hanno fatto un numero di 
	goal maggiore del numero dei goal subiti.  
	• Letto a terminale un codice di una squadra stampi a video il nome della squadra, 
	i goal fatti e i goal subiti
*/
#include <stdio.h>
#define N 2
struct squadraS
{
	char nome_squadra[20];
	int codice_squadra;
	int goal_fatti;
	int goal_subiti;
};

void rich(struct squadraS *sq)
{
	int i;
	for( i = 0 ; i < N ; i++ )
	{
		printf("Nome %d: ",i+1);
		gets(sq[i].nome_squadra);
		printf("Codice squadra %d: ",i+1);
		scanf("%d",&sq[i].codice_squadra);
		printf("Goal fatti %d: ",i+1);
		scanf("%d",&sq[i].goal_fatti);
		printf("Goal subiti %d: ",i+1);
		scanf("%d",&sq[i].goal_subiti);
		getchar();
	}
}

void golmag(struct squadraS *sq)
{
	int i;
	for ( i = 0 ; i < N ; i++ )
	{
		if ( sq[i].goal_fatti > sq[i].goal_subiti )
			printf("%d",sq[i].codice_squadra)
	}
}

void ricerca(struct squadraS *sq)
{
	
}

int main(void)
{
	// Variabili
	struct squadraS squadra[N];
	// Carica
	rich(squadra);
	golmag(squadra);
	return 0;
}















