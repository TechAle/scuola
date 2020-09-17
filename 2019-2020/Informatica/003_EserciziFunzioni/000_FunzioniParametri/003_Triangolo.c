/*
	Name: Triangolo
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: Scrivere un programma che 
	dato in input base altezza di un triangolo rettangolo passi tali valori ad una funzione attraverso la quale 
	si possano stabilire ipotenusa, area e perimetro del triangolo
*/
#include <stdio.h>
#include <math.h>
// Dichiarazione Funzioni
float Perimetro(float base, float altezza, float ipotenusa);
float Area(float base, float altezza);
float Ipotenusa(float base, float altezza);
// Funzione
float Ipotenusa(float base, float altezza)
{
	return (sqrt(pow(base,2)+pow(altezza,2)));
}
float Perimetro(float base, float altezza, float ipotenusa)
{
	return (base+altezza+ipotenusa);
}
float Area(float base, float altezza)
{
	return ((base*altezza)/2);
}
// Main
int main(void)
{
	// Variabile
	float base,
		  altezza,
		  ipotenusa;
	// Input
	printf("Base, altezza: ");
	scanf("%f%f",&base,&altezza);
	// output
	ipotenusa = Ipotenusa(base, altezza);
	printf("Perimetro: %f\nArea: %f\nIpotenusa: %f",Perimetro(base,altezza,ipotenusa),Area(base, altezza), ipotenusa);
	
}
