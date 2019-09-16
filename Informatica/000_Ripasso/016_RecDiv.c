/*
	Name: Sottrazione Per divisione
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Sviluppare una funzione ricorsiva per il calcolo della divisione di due numeri interi a e b (entrambi positivi), mediante la tecnica delle sottrazioni successive.
 */
#include <stdio.h>
int divisione(int num, int div)
{
    int i = 0;
    while (num-div<div)
    {
        num -= div;
        i++;
    }
    return i;
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
    printf("risultato: %d",divisione(num1,div));
}
