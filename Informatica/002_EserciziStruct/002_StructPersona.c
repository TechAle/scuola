/*
	Name: esame
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Scrivere un programma C che definisca la struttura “persona” composta da nome, cognome, indirizzo,
provincia e data di nascita (array di interi composto da 3 elementi). Si richiedano tutti i dati e si stampino a
video.
 */
#include <stdio.h>
// struct for person variable
struct S_persona
{
	char nome[10];
	char cognome[10];
	char indirizzo[20];
	char provincia[10];
	int data_nascita[3];	
};
// main
int main(void)
{
	// variables
	struct S_persona persona;
	// inputs
	printf("inserire nome, cognome, indirizzo, provincia, data di nascita (1 5 2002)");
	scanf("%s%s%s%s%d%d%d",persona.nome,persona.cognome,persona.indirizzo,persona.provincia,persona.data_nascita[0],persona.data_nascita[1],persona.data_nascita[2]);
	// output
	printf("dati:\nnome-cognome:\t%s\t%s\nprovincia-indirizzo\t%s\t%s\ndata di nascita:\t%d/%d/%d",persona.nome,persona.cognome,persona.provincia,persona.indirizzo,persona.data_nascita[0],persona.data_nascita[1],persona.data_nascita[2]);
	
}
