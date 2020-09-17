/*
	Name: Esercizio 2
	Author: Alessandro Condello
	Date: 22:10:2019
	Description: Scrivere un programma C che definisca la struttura “persona” composta da nome, 
				cognome, indirizzo,
				provincia e data di nascita (array di interi composto da 3 elementi). 
				Si richiedano tutti i dati e si stampino a
				video.
*/
#include <stdio.h>
#include <string.h>
#include <ctype.h>
struct data_nascita
{
	int giorno,
		mese,
		anno;
};
struct personaS
{
	char nome[20];
	char cognome[20];
	char indirizzo[20];
	struct data_nascita data;
};

void rich(struct personaS *pers)
{
	printf("Nome: ");
	gets((*pers).nome);
	printf("Cognome: ");
	gets((*pers).cognome);
	printf("Indirizzo: ");
	gets((*pers).indirizzo);
	printf("Giorno nascita: ");
	scanf("%d",&(*pers).data.giorno);
	printf("Mese nascita: ");
	scanf("%d",&(*pers).data.mese);
	printf("Anno nascita: ");
	scanf("%d",&(*pers).data.anno);
}

void stampa(struct personaS pers)
{
	printf("Nome: %s\nCognome: %s\nIndirizzo: %s\nNato il %d/%d/%d",pers.nome,pers.cognome,pers.indirizzo,pers.data.giorno,pers.data.mese,pers.data.anno);
}

int main()
{
	struct personaS pers;
	rich(&pers);
	stampa(pers);
}
