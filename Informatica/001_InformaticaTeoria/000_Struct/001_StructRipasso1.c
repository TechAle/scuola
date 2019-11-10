/*
	Name: Strutture
	Author: Alessandro Condello
	Date: 17/09/19 09:59
	Description: Creare 2 struct, 1 chiede input e 1 viene inizializzata, e poi una tabella
				 Della tabella fare ricerca, caricamento e stampa
*/
#include <stdio.h>

// create struct auto
struct Auto_
{
	char targa[20];
	char modello[10];
	int disponibile;
	int vel;
};
#define N 3
int main()
{
	// variables //
	struct Auto_ Macchina,
				 Macchine[N];
	int	S_d = 1,
		S_V = 360,
		t = 0,
		i;
	char S_T = "0000",
		 S_mod = "t";
	// initilation macchina
	Macchine.disponibile = 1;
	Macchine.modello = "tesla";
	Macchine.targa = "py391la";
	Macchine.vel = 360;
	// input
	for(i=0;i<N;i++)
	{
		printf("inserire: targa, modello, disponibilita, velocita ");
		scanf("%s%s%d%d",Macchine[i].targa,Macchine[i].modello,&Macchine[i].disponibile,&Macchine[i].vel);
	}
	// search value targa
	i = 0;
	while(!t && i<N)
		if(!strcmp(S_T,Macchine[i].targa))
			t++;
		else
			i++
	if(t == 1)
		printf("targa trovata\n");
	else
		printf("targa non trovata\n");
	// search value modello
	i = t = 0;
	while(!t && i<N)
		if(!strcmp(S_mod,Macchine[i].modello))
			t++;
		else
			i++
	if(t == 1)
		printf("modello trovato\n");
	else
		printf("modello non trovato\n");
	// search value disponibile
	
	i = t = 0;
	while(!t && i<N)
		if(S_d == Macchine[i].disponibile)
			t++;
		else
			i++
	if(t == 1)
		printf("uno e disponibile\n");
	else
		printf("niente p disponibile\n");
	
	// final output
	printf("\noutput:\n\n");
	for(i=0;i<N;i++)
		printf("macchina %d:\ntarga:\t%s\nmodello:\t%s\nvelocita:\t%d\ndisponibile:\t%d"i+1,Macchine[i].targa,Macchine[i].modello,Macchine[i].vel,Macchine[i].disponibile);
}
















