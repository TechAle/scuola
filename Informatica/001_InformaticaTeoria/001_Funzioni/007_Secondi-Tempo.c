#include <stdio.h>
#include <stdlib.h>
#include <time.h>

void tempo(int secondi,int tempo_[3])
{
	// ore
	tempo_[0] = secondi/3600;
	// minuti
	tempo_[1] = tempo_[0]%3600/60;
	// secondi
	tempo[2] = tempo_[1]%3600%60;
}
int main()
{
	// Variabili
	srand(time(NULL));
	int secondi = rand();
	int tempo_[3];
	tempo(secondi, tempo_);
	printf("ore: %d\nminuti: %d\nsecondi: %d",tempo_[0],tempo_[1],tempo_[2]);
}
