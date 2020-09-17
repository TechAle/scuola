/*
	Name: Calcolo fattoriale
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: Si scriva una funzione in C, denominata fatt, che calcoli il fattoriale di un numero intero
				 dato. Il numero è una variabile globale. Per via della velocità di crescita della funzione, il
				 valore restituito deve essere codificato in un double, nonostante sia in effetti un valore
				 intero.
*/
#include <stdio.h>
double num;
double fatt()
{
	int i;
	double ris = 1;
	for(i=num;i>1;i--)
		ris *= i;
	return ris;
}
void main()
{
	printf("Numero: ");
	scanf("%lf",&num);
	printf("Numero fattoriale di %lf: %lf",num,fatt());
}

