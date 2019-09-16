/*
	Name: ricerca
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: 8.	Sono dati due vettori contenenti rispettivamente peso ed altezza
	di tutti gli alunni di una classe. 
	Ogni alunno è determinato dalla posizione occupata nel vettore. 
	Determinare l'alunno con minor rapporto peso/altezza^2.
*/
#include <stdio.h>
#include <math.h>
#define N 3
int main()
{
	// variables //
	int i,
		peso[N],
		altezza[N],
		pos[N],
		cont;
	float 	rapporto[N],
			min;
	// input h + p
	for(i=0;i<N;i++)
	{
		printf("inserire %d input: peso altezza ",i+1);
		scanf("%d%d",&peso[i],&altezza[i]);
		rapporto[i] = peso[i] / pow(altezza[i],2);
		// algoritm minim
		if(i==0)
		{
			min = rapporto[0];
			pos[0] = 0;
			cont = 0;
		}
		else
			if(min == rapporto[i])
			{
				cont++;       
				pos[cont] = i;
			}
			if(min>rapporto[i])
			{
				min = rapporto[i];
				pos[0] = i;
				cont = 0;
			}
	}
	// output result                        
	printf("alunni %d rapporto %f\n",pos[0],min);
	if(cont>0)
		{
			printf("altri alunni con lo stesso risultato: ");
			for(i=1;i<=cont;i++)
				printf("%d ",pos[cont]);
		}
	
	
}
