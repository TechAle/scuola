/*
	Name: ricerca
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Letto in input un array A di n interi, costruire un array B
	con gli stessi elementi di A, ma memorizzati al contrario
	(il primo elemento di A è l'ultimo elemento di B,
	l'ultimo elemento di A è il primo di B). Stampare il vettore B.
 */
#include <stdio.h>
#include <string.h>
#include <ctype.h>
#define MAX 10
int main()
{
    // variables //
    char    a[MAX],
            b[MAX];
    int i,
        j;
    // input first sentence //
    printf("inserire la prima frase ");
    gets(a);
    // reverse A
    j = 0;
    for(i=strlen(a)-1;i>=0;i--)
    {
        b[j] = a[i];
        j++;
    }
    // output inverted sentenc
    printf("frase invertita: %s",b);
}
