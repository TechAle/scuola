/*
	Name: Testa o Croce
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Scrivere un programma per simulare il famoso gioco “testa o croce”. Il programma deve ricevere in input dal giocatore quale segno vuole scegliere (T per la testa e C per la croce). Se c’è corrispondenza con il valore scelto casualmente dal computer, allora il programma deve stampare “hai vinto”, altrimenti “hai perso”.
 */
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>
#define MAX 6
#define debug 0
int main()
{
    // variables //
    char scelta[MAX];
    int n_scelta;
    // input
    printf("testa o croce?");
    gets(scelta);
    // random
    /*
     0 = head
     1 = cross
     */
    if(strcmp("head", scelta) == 1)
        n_scelta = 0;
    else
        n_scelta = 1;
    srand(time(NULL));
    // 10 test and in only 1 i won.. yeha that's lucky
    if(n_scelta == (rand() % (1 + 1 - 0)) + 0)
        printf("hai preso");
    else
        printf("hai vinto");
    
    
}
