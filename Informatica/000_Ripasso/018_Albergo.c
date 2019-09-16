/*
	Name: Moltiplicazione per addizione
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Per gestire le camere di un albergo si hanno a disposizione gli array CAMERE dove sono contenuti i numeri identificativi delle camere, POSTI dove è contenuto il numero di posti (da 1 a 4) di ciascuna camera, e LIBERO indica, per ogni camera, se è libera (=0) oppure occupata (=1).
 Realizzare un'applicazione in grado di:
 • Visualizzare la capienza totale dell'albergo (quante persone in tutto può ospitare) e quante persone sono ospitate nell'albergo;
 • Visualizzare se la camera, il cui identificativo è inserito da input, è libera o occupata. Se la camera non esiste emettere la segnalazione di errore; • Visualizzare il numero di camere da 1, da 2, da 3 e da 4 posti letto (suggerimento: utilizzare l'array NUMCAMERE di 4 elementi in cui memorizzare i conteggi);
 • Gestire una prenotazione: inserito in input il numero X di persone, cercare, se esiste, una camera libera che possa ospitare tutte le persone. Se esiste portare a 1 il relativo elemento dell'array LIBERO per indicare che ora la camera è occupata, altrimenti dare una segnalazione di avviso.
 */
#include <stdio.h>

// struct for the room
struct albergo
{
    int posti;
    int libero;
};

#define MAX 3
int main()
{
    // variables //
    /// for the rooms
    struct albergo camere[MAX];
    int i,
        scelta,
        somma,
        app;

    // inputs //
    for(i=0;i<MAX;i++)
    {
        printf("inserire la %d camera (posti + libero)",i+1);
        scanf("%d%d",&camere[i].posti,&camere[i].libero);
    }
    // menu
    somma = 0;
    do {
        // input
        printf("1) Capienza albergo\n2) Camera libera\n3) Post letto\n4) prenotazione\n5) uscita");
        scanf("%d",&scelta);
        // analyze
        switch (scelta)
        {
            // case capacity
            case 1:
                // addiction + output
                for(i=0;i<MAX;i++)
                    somma += camere[i].posti;
                printf("posti totali: %d\n",somma);
                break;
            // case check if is free
            case 2:
                printf("inserire l'id");
                scanf("%d",&somma);
                // if is < N of room
                if(somma<=MAX && somma >=1)
                    // if yes
                    if(camere[somma++].libero == 1)
                        printf("e libero\n");
                    else
                        printf("non e libero\n");
                
                else printf("camera non esiste\n");
                break;
            // case search letto
            case 3:
                printf("inserisci il posto letto ");
                scanf("%d",&somma);
                if(somma>=1 && somma <= 4)
                {
                    // addiction all room with %d bed
                    app = 0;
                    for(i=0;i<MAX;i++)
                        if(camere[i].posti == somma)
                            app++;
                    if(app == 0)
                        printf("non esistono\n");
                    else
                        printf("esistono %d camere\n",app);
                }
                break;
            // case booking
            case 4:
                printf("inserire le persone ");
                scanf("%d",&somma);
                if(somma>=1 && somma <= 4)
                {
                    app = i = 0;
                    while (i < MAX && !app)
                    {
                        if(camere[i].posti <= somma && camere[i].libero == 1)
                        {
                            app = !app;
                            camere[i].libero = !camere[i].libero;
                        }else
                            i++;
                    }
                }
                break;
            // case number dont exist
            default:
                printf("errore\n");
                break;
        }
    } while (scelta != 5);
}







