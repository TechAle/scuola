/*
	Name: bolletta
	Auture: Condello Alessandro
	Date: 13/09/19 10:23
	Description: 2.	Scrivere un programma per determinare il numero di scatti effettuati 
	da un utente telefonico e l'ammontare della sua bolletta. 
	Vengono forniti in input i seguenti dati:
"	Nome dell'utente
"	Numero di scatti emersi dalla lettura della bolletta precedente
"	Numero di scatti emersi dalla lettura della bolletta attuale 
"	Costo di uno scatto

*/
#include <stdio.h>
int main()
{
	/// variabili ///
	char utente[10];
	int scatti_p,
		scatti_d;
	float 	cost,
			fisso;
	
	// input
	printf("inserire nome utente");
	scanf("%s",utente);
	
	printf("inserire scatti fatti in precedenza, scatti fatti ora e il costo di uno scatto e il canone fisso");
	scanf("%d%d%f%f",&scatti_p,&scatti_d,&cost,&fisso);
	
	// output
	int scatti = scatti_d-scatti_p;
	
	printf("signore %s hai eseguito %d scatti con un costo di %f",utente,scatti,scatti*cost+fisso);
	
}
