/*
	Name: AreaCerchioStampa
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: Scrivere un programma che dato in input il raggio di un cerchio ne stampi l'area utilizzando una funzione che 
	riceve il raggio dal programma principale attraverso un passaggio per valore. 
*/
#include <stdio.h>
#include <math.h>
// Dichiarazione Funzioni
void areaCer(float raggio);
// Funzione
void areaCer(float raggio)
{
	printf("Circonferenza: %f",M_PI*pow(raggio,2));
}
// Main
int main(void)
{
	// Variabile
	float raggio;
	// Input
	printf("Raggio: ");
	scanf("%f",&raggio);
	// output
	areaCer(raggio);
}
