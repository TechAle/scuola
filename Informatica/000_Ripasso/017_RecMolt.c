/*
	Name: Moltiplicazione per addizione
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Sviluppare una funzione ricorsiva per il calcolo della potenza di due numeri interi a e b (entrambi positivi), mediante la tecnica delle moltiplicazioni successive.
 */
#include <stdio.h>
int moltiplicazione(int num, int div)
{
    int i = 0;
    for(i=0;i<div;i++)
        num += num;
    return num;
}
#define MAX 15
int main()
{
    // variables //
    int     num1,
            div;
    // input
    printf("inserire 2 numeri");
    scanf("%d%d",&num1,&div);
    printf("risultato: %d",moltiplicazione(num1,div));
}
