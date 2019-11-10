#include <stdio.h>
#include <string.h>
#define N 10
#define M 30

void carica(char citta[N][M]);
void stampa(char citta[N][M]);
void ricerca(char citta[N][M]);
void ordina(char citta[N][M]);

void carica(char citta[N][M])
{
	int i;
	for( i = 0 ; i < N ; i++ )
	{
		printf("%d citta ",i+1);
		gets(citta[i]);
	}


}

void stampa(char citta[N][M])
{
	int i;
	for( i = 0 ; i < N ; i++ )
		printf("%s\n",citta[i]);
}

void ordina(char citta[N][M])
{
	int i,
		j;
	char app[M];
	
	for( i = 0 ; i < N-1 ; i++ )
		for ( j = i+1 ; j < N ; j++)
			if ( strcmp(citta[j],citta[i]) < 0 )
				{
					strcpy(app,citta[i]);
					strcpy(citta[i],citta[j]);
					strcpy(citta[j],app);
				}
}

void ricerca(char citta[N][M])
{
	int i,
		t = 0;
	while(i<N && !t)
		if ( strcmp("novara",citta[i]) == 0 )
			t = 1;
		else
			i += 1;
	if (t)
		printf("Stringa trovata");
	else
		printf("Stringa non trovata");
}

int main()
{
	char cittav[N][M];
	carica(cittav);
	ricerca(cittav);
	ordina(cittav);
	stampa(cittav);
	return 0;
}
