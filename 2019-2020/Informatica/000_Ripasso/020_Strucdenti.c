/*
	Name: Strucdenti
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Creare in memoria una tabella (array di struct) di studenti (ogni studente è caratterizzato da un cognome e da un certo numero di voti). Dopo aver inizializzato la tabella, stamparne a video il contenuto.
 */
#include <stdio.h>

#define MAX 3

struct studenti
{
    char cognome[15];
    int voti[2];
};

int main()
{
    
    // variables //
    struct studenti alunno[MAX];
    int i;
    // input
    for(i=0;i<MAX;i++)
    {
        printf("inserire cognome e 2 voti");
        scanf("%s%d%d",alunno[i].cognome,&alunno[i].voti[0],&alunno[i].voti[1]);
    }
    // output
    for(i=0;i<MAX;i++)
        printf("alunno\t%d\ncognome:\t%s\nvoti:\t%d\t%d",i+1,alunno[i].cognome,alunno[i].voti[0],alunno[i].voti[1]);
    
    
}







