/*
	Name: Struct di Struct
	Author: Alessandro Condello
	Date: 19/09/19 09:21
	Description: Creare una struct di struct e fare<: inserimento, stampa, ricerca
*/
#include <stdio.h>
#define N_cl 3
struct S_classe
{
	char alunno[20];
	int voto;
	char classe_[5]
};
// struct scuola -> classe
struct S_scuola
{
	char nome[20];
	struct S_classe classe[3];
};
// main
int main(void)
{
	
	// variables //
	struct S_scuola scuola;
	int i;
	// tables in a struct // 
	// input
	printf("inserire il nome della scuola");
	scanf("%s",scuola.nome);
	for(i=0;i<N_cl;i++)
	{
		printf("inserire il nome dell'alunno e il suo voto e la classe");
		scanf("%s%d%s",scuola.classe.alunno,&scuola.classe.voto,scuola.classe.classe_);
	}
	
	
	// only struct
}
