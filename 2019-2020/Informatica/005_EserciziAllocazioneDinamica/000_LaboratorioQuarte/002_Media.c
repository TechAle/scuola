/*
	Name: Media senza duplicati
	Author: Condello Alessandro
	Date: 08/11/19 10:05
	Description: 
*/
#include <stdio.h>
#include <stdlib.h>
void media(int val[], int len_)
{
	int *vet,
		i,
		j,
		cont = 1;
	float media = 0;
	vet = (int*)malloc(len_*sizeof(int));
	vet = val;
	for(i = 1 ; i < len_ ; i++)
	{
		j = 0;
		do
		{
			if ( *(vet + cont - 1 + j) != *(val + i ) )
			{
				j++;
			}
			else
			{
				j = cont+1;
			}
		}while(j < cont);
		if (j != cont+1)
		{
			*(vet + cont) = *(val+i);
			cont++;
		}
	}
	// Somma
	for(i = 0 ; i < cont ; i++)
		media += *(vet+i);
	printf("%f",media/cont);
	
	

}
int main()
{
	int len_ = 5;
	int val[5] = {5,1,5,9,1};
	
	media(val,len_);
}
