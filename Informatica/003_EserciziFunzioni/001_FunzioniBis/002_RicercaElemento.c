/*
	Name: Ricerca di un elemento in vettore
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: Si scriva una funzione in C, denominata cerca, che ricerchi la presenza di un elemento in un
				 vettore di interi. Il vettore e il valore x da cercare sono varabili globali
				 La funzione deve restituire un valore intero, ed in particolare:
				 • se il valore x è presente nel vettore, allora la funzione restituisce l’indice della posizione
				 alla quale si trova tale valore;
   				 • se il valore x è presente più volte, si restituisca l’indice della prima occorrenza;
				 • se il valore x non è presente nel vettore, si restituisca -1.
*/
#include <stdio.h>
#define N 5
void rich(int vet[], int len_);

void rich(int vet[], int len)
{
	int i;
	for(i = 0; i < len ; i++)
	{
		printf("%d valore: ",i+1);
		scanf("%d",&vet[i]);
	}
}


int main()
{
	int vet[N];
	rich(vet,N)
}






