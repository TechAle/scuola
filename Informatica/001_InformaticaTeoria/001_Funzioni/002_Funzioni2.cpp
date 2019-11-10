/*
	Name: Funzioni 2
	Author: Alessandro Condello
	Date: 01/10/19 08:44
	Description: Creare 2 funzioni con ritorno: una fà la moltiplicazioni e l'altra le divisioni
*/
#include <stdio.h>
// Dichiarazione Funzioni
float moltiplica(float n1,float n2);
float dividi(float n1,float n2);
// Funzioni
float moltiplica(float n1, float n2)
{
	return n1*n2;
}
float dividi(float n1, float n2)
{
	return n1/n2;
}
// Main
int main()
{
	/// Variabili
	float n1 = 4,
		n2 = 2;
	// Stampe
	printf("moltiplicazione: %f\n",moltiplica(n1,n2));
	printf("divisione: %f\n",dividi(n1,n2));

}

