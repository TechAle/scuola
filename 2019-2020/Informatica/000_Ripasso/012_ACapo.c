/*
	Name: a capo
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Scrivere un programma in linguaggio C che legga una frase introdotta da tastiera. La frase contiene complessivamente al più 100 caratteri. Il programma deve svolgere le seguenti operazioni:
 • Visualizzare la frase inserita
 • Costruire una nuova frase in cui tutte le occorrenze del carattere ’.’ sono sostituite con il carattere di newline ’\n’. Il programma deve memorizzare la nuova frase in un’opportuna variabile
 • Visualizzare la nuova frase
 */
#include <stdio.h>
#include <string.h>
#include <ctype.h>
#define MAX 300
#define debug 0
int main()
{
    // variables //
    char    frase[MAX],
            frase2[MAX] = "",
            testo[MAX] = "We have never been to Asia, nor have we visited Africa.I think I will buy the red car, orI will lease the blue one.He said he was not there yesterday.however, many people saw him there.Iwould have gotten the promotion.";
    const char target[2] = ".";
    char *token;

    // input first sentence //
    printf("inserire la frase ");
    if (!debug)
        gets(frase);
    else
        strcpy(frase, testo);
    if(strlen(frase) >= 100)
    {
        // output sentence
        printf("frase:\n\n");
        puts(frase);
        // get the token
        printf("\nfrase finale:\n\n");
        token = strtok(frase, target);
        // "repleace" the token
        while (token != NULL)
        {
            printf("%s\n", token);
            // reload
            token = strtok(NULL, target);
        } // return error
    }else printf("la frase non è lunga 100 caratteri.");
    
    
}
