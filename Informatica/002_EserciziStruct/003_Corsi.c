/*
	Name: corsi
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Si realizzi un programma C che definisca una struttura che permetta di contenere i dati relativi ad alcuni
corsi. In particolare, per ogni corso vengono forniti: denominazione del corso: una stringa di 20 caratteri
che riporta il nome del corso; cognome del docente: una stringa di 15 caratteri che rappresenta il
cognome del docente del corso; iscritti: un intero che indica il numero di studenti che frequentano il
corso. Il programma deve:
• caricare una struct di tipo corso e stamparla, contanto le consonanti minuscole del nome del corso
e del cognome del docente
• stampare la denominazione del corso e il cognome del docente relativi a tutti i corsi che hanno il
numero di iscritti maggiore o uguale alla media aritmetica degli iscritti (calcolata su tutti i corsi).
 */
#include <stdio.h>
#include <string.h>
#include <ctype.h>
// scruct corsi
struct S_corsi
{
	char den[20];
	char c_doc[15];
	int iscritti;
};
#define N 3
// main
int main()
{
	// variables //
	struct S_corsi corsi[N];
	int i,
		j,
		min[N][2];
	float media;
	// inputs //
	for(i=0;i<N;i++)
	{
		printf("insert the surname of the course coordinator, the name of the course and the numbers of the students ");
		scanf("%s%s%d",corsi[i].c_doc,corsi[i].den,&corsi[i].iscritti);
	}
	// count the low letter of the surname
	for(i=0;i<N;i++)
	{
		// min is an matrix:
		// in [][0] contain the vowel of the docent
		// the [][1] contain the vowel of the course  
		min[i][0] = 0;
		min[i][1] = 0;
		// controll the vowel of the course
		for(j=0;j<strlen(corsi[i].den);j++)
			if(corsi[i].den[j] != 'a' && corsi[i].den[j] != 'e' && corsi[i].den[j] != 'i' && corsi[i].den[j] != 'o' && corsi[i].den[j] != 'u')
				if(islower(corsi[i].den[j]))
					min[i][1]++;
		// controll the vowel of the surname
		for(j=0;j<strlen(corsi[i].c_doc);j++)
			if(corsi[i].c_doc[j] != 'a' && corsi[i].c_doc[j] != 'e' && corsi[i].c_doc[j] != 'i' && corsi[i].c_doc[j] != 'o' && corsi[i].c_doc[j] != 'u')
				if(islower(corsi[i].c_doc[j]))
					min[i][0]++;
				
	}
	// calculate averange number of the students
	media = 0;
	for(i=0;i<N;i++)
		media += corsi[i].iscritti;
	media /= N;
	// print if the average is <= of the course[i] numbers of student
	for(i=0;i<N;i++)
		if(media <= corsi[i].iscritti)
			printf("course name: %s (lower consonant: %d)\nsurname of the coordinator: %s (lower consonant: %d)\n",corsi[i].den,min[i][1],corsi[i].c_doc,min[i][0]);
	
}











