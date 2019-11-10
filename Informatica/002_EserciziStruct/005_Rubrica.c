/*
	Name: rubrica
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Scrivere un programma C che crei una rubrica telefonica, usando una struct “persona” (nome, cognome,
numero di telefono, e-mail). Il programma chiede il nome da cercare e stampa a video la scheda
corrispondente.
 */
 // struct phone book
struct S_Person
{
	char nome[20],
			cognome[20],
			n_tel[20],
			email[20];
};

#include <stdio.h>
#include <string.h>
#define N 0
int main()
{
	// variables //
	struct S_Person PhoneBook;
	char sc[20];
	// initilation
	strcpy(PhoneBook.nome,"ale");
	strcpy(PhoneBook.cognome,"com");
	strcpy(PhoneBook.n_tel,"39");
	strcpy(PhoneBook.email,"ciao@");
	// search
	printf("insert the name to search ");
	gets(sc);
	
}
