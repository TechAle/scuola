/*
	Name: Esercizio 3
	Author: Alessandro Condello
	Date: 22:10:2019
	Description: Si realizzi un programma C che definisca una struttura che permetta di contenere 
				i dati relativi ad alcuni
				corsi. In particolare, per ogni corso vengono forniti: denominazione del corso: 
				una stringa di 20 caratteri
				che riporta il nome del corso; cognome del docente: una stringa di 
				15 caratteri che rappresenta il
				cognome del docente del corso; iscritti: un intero che indica il numero 
				di studenti che frequentano il
				corso. Il programma deve:
				• caricare una struct di tipo corso e stamparla, contanto le consonanti 
				minuscole del nome del corso
				e del cognome del docente
				• stampare la denominazione del corso e il cognome del docente relativi 
				a tutti i corsi che hanno il
				numero di iscritti maggiore o uguale alla media aritmetica 
				degli iscritti (calcolata su tutti i corsi).
*/
#include <stdio.h>
#include <string.h>
#include <ctype.h>
struct corsiS
{
	char nome[20];
	char cognomeDocente[15];
	int iscritti;
};

void rich(struct corsiS *corso)
{
	printf("Nome docente: ");
	scanf("%s",(*corso).nome);
	printf("Cognome docente: ");
	scanf("%s",(*corso).cognomeDocente);
	printf("N iscritti: ");
	scanf("%d",&(*corso).iscritti);
}

void stampa(struct corsiS corso)
{
	printf("Nome docente: %s\nCognome docente: %s\nN iscritti: %s\nConsonanti corso: %d\n",corso.nome,corso.cognomeDocente, corso.iscritti,consonantiMinuscole(corso.cognomeDocente));
}

int consonantiMinuscole(char cognome[])
{
	int i,
		cont = 0;
	for ( i = 0 ; i < strlen(cognome) ; i++ )
		if ( islower(cognome[i]) &&)
			if ( isConsonante(cognome[i]) )
				cont++;
	
}

int isConsonante(char lettera)
{
	if ( lettera != 'a' && lettera != 'e' && lettera != 'i' && lettera != 'o' && lettera != u)
		return 1
	return 0
}

#define N 10
int main()
{
	struct corsiS corso,
				  corsi[N];
	int quantita,
		i;
	// Input
	rich(&corso);
	// Stampa
	stampa(corso);
	// Input quantita corsi
	printf("N corsi: ");
	scanf("%d",&quantita);
	// Input
	printf("Altri corsi:\n")
	for (i = 0 ; i < quantita ; i++)
		rich(&corsi[i]);
	for(i = 0 ; i < quantita ; i++)
		stampa(corsi[i]);
}
