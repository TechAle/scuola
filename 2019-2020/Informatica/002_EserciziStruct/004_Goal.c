/*
	Name: goal
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Si scriva un programma C che definisca una struttura che permetta di contenere una serie di dati (struct
squadra) del tipo: nome_squadra (stringa di lunghezza 20) ; codice_squadra (intero); goal_fatti (intero) ;
goal_subiti (intero) .
• Li si memorizzi in un vettore di strutture "squadre";
• Stampi a terminale tutti i nomi e codici delle squadre che hanno fatto un numero di goal maggiore del
numero dei goal subiti.
• Letto a terminale un codice di una squadra stampi a video il nome della squadra, i goal fatti e i goal subiti.
 */
#include <stdio.h>
struct squadre
{
	char nome_squadra[20];
	int codice_squadra;
	int goal_fatti;
	int goal_subiti;
};
// main
#define N 3
int main()
{
	// variables //
	struct squadre squadra[N];
	int i,
		app,
		fin;
	// inputs //
	for(i=0;i<N;i++)
	{
		printf("insert: name of the team, code of the team, goal done and goal recevied ");
		scanf("%s%d%d%d",squadra[i].nome_squadra,&squadra[i].codice_squadra,&squadra[i].goal_fatti,&squadra[i].goal_subiti);
	}
	// output
	for(i=0;i<N;i++)
	{
		if(squadra[i].goal_fatti > squadra[i].goal_subiti)
		{
			printf("name: %s\tcode:%d\n",squadra[i].nome_squadra,&squadra[i].codice_squadra);
			app = 1;
		}
	}
	if(app == NULL)
		printf("No teams done goal > goal recived ");
	printf("insert a code ");
	scanf("%d",&app);
	i = fin = 0;
	// search
	do
	{
		if(squadra[i].codice_squadra == app)
			fin = !fin;
		else
			i++;
	}while(i>=N && !fin)
	// if the code is found
	if(fin)
		printf("goal done: %d\tgoal recived: %d",squadra[i].goal_fatti,squadra[i].goal_subiti);
	else
		printf("no teams match with %d",app);
}














