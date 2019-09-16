/*
	Name: Strucdenti
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: In riferimento alla tabella dell’esercizio precedente, eseguire attraverso un apposito menù le seguenti operazioni:
 • Stampa della media dei voti di ciascuno studente
 • Stampa del voto più alto di ciascuno studente
 • Stampa del cognome dello studente con la media più alta
 */
#include <stdio.h>

#define MAX 3
#define V_M 2

struct studenti
{
    char cognome[15];
    int voti[V_M];
};

int main()
{
    
    // variables //
    struct studenti alunno[MAX];
    int i,
        j;
    // input
    for(i=0;i<MAX;i++)
    {
        printf("inserire cognome");
        scanf("%s",alunno[i].cognome);
        for(j=0;j<V_M;j++)
        {
            printf("inserire %d voto ",i+1);
            scanf("%d",&alunno[i].voti[j]);
        }
    }
    // output
    for(i=0;i<MAX;i++)
    {
        printf("alunno\t%d\ncognome:\t%s\nvoti:",i+1,alunno[i].cognome);
        for(j=0;j<V_M;j++)
            printf("%d ",alunno[i].voti[j]);
        }
    // 2 part
    // variables //
    float media,max_m;
    int voto_m,p;
    for(i=0;i<MAX;i++)
    {
        media = 0;
        for(j=0;j<V_M;j++)
        {
            media += alunno[i].voti[j];
            if(j==0)
                voto_m = alunno[i].voti[0];
            else
                if(voto_m<alunno[i].voti[j])
                    voto_m = alunno[i].voti[j];
        }
        media/=V_M;
        if(i==0)
        {
            max_m = media;
            p = 0;
        }
        else
            if(max_m < media)
            {
                max_m = media;
                p = i;
            }
        printf("%s voto: %d media: %.2f\n",alunno[i].cognome,voto_m,media);
        
    }
    printf("alunno più bravo: %s",alunno[p].cognome);
    
    
}







