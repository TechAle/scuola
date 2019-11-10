/*
	Name: Alessandro Condello
	Date: 14/10/19 08:06
	Description: Fare la funzione del minimo
*/
#include <stdio.h>
#include <limits.h>
#define N 5
void rich(float vet[], int len)
{
	int i;
	for(i = 0; i < len ; i++)
	{
		printf("%d valore: ",i+1);
		scanf("%f",&vet[i]);
	}
}

float minimo(float vet[], int len)
{
	int i;
	float min = INT_MAX;
	for ( i = 0 ; i < len ; i++ )
		if (min > vet[i])
			min = vet[i];
	return min;
}

int main(void)
{
	float vet[N];
	
	rich(vet,N);
	printf("Minimo: %f",minimo(vet, N));
}
