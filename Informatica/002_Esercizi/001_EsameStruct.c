/*
	Name: esame
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Scrivere un programma C che definisca la struttura “esame”, composta dal nome dell’esame (stringa) e dal
 voto (intero). Si leggano poi da terminale
 • 1 esame e lo si stampi. Si contino e stampino le vocali minuscole del nome
 • n esami, con n definito dall’utente (max 30), e si inseriscano in un array. L’utente inserisca poi il
 nome di un esame da cercare e si stampi il relativo voto, se l'esame è presente.
 */
#include <stdio.h>
#include <string.h>
// struct for containing name of the exam and the mark
struct esame
{
    char nome[15];
    int voto;
};
#define N 3
int main()
{
    // variables //
    struct esame corso[N];
    int scelta,
        i,
        fine;
    char esame_nome[15];
    // input how many exams
    printf("inserire la quantita ");
    scanf("%d",&scelta);
    if(scelta > 0 && scelta < N)
    {
        for(i=0;i<scelta;i++)
        {
            printf("inserire nome esame ");
            gets(corso[i].nome);
            scanf("inserire il voto ");
            scanf("%d",&corso[i].voto);
            
        }
        
        // input name exam
        printf("inserire il nome dell'esame ");
        gets(esame_nome);
        i = fine = 0;
        while(i<scelta && !fine)
            if(!strcmp(esame_nome, corso[i].nome))
                fine = 1;
    }
    
    
}
