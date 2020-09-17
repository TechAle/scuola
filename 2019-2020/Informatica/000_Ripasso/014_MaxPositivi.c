/*
	Name: Massimo Positivi
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Dati in input 10 numeri positivi, trovare il massimo e visualizzarlo.
 */
#include <stdio.h>
#define MAX 3
int main()
{
    // variables //
    unsigned int numeri[MAX],
                 max;
    int i;
    // input
    for(i=0;i<MAX;i++)
    {
        printf("inserire %d numero",i+1);
        scanf("%ud",&numeri[i]);
        // max
        if(i==0)
            max = numeri[0];
        else
            if(max < numeri[i])
                max = numeri[i];
    }
    // output
    printf("max: %ud",max);
}
