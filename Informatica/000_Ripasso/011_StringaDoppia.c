/*
	Name: raddoppio
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Raddoppiare i caratteri corrispondenti alle vocali che compaiono in una stringa s ricevuta in ingresso. Le vocali dovranno comparire sullo schermo raddoppiate in modo da mostrare, partendo ad esempio da "uomo", la stringa "uuoomoo"..
 */
#include <stdio.h>
#include <string.h>
#include <ctype.h>
#define MAX 10
int main()
{
    // variables //
    char    a[MAX],
            b[MAX*2];
    int i,
        j,
        k;
    // input first sentence //
    printf("inserire la prima frase ");
    gets(a);
    // double A
    j = 0;
    for(i=0;i<strlen(a);i++)
    {
        for(k=0;k<2;k++)
        {
            b[j] = a[i];
            j++;
        }
    }
    // output double sentenc
    printf("frase doppiata: %s",b);
}
