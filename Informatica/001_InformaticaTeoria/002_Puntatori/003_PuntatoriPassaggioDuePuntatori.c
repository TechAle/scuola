/*
	Name: Puntatori passaggio (2-3) 2 puntatori
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: passare due valori con due puntatori
*/
#include <stdio.h>
void modifica(int *pX, int *pY)
{
	(*pX)++;
	(*pY)--;
}

int main(void)
{
	int x = 3, y = 4;
	printf("%d %d\n",x,y);
	modifica(&x,&y);
	printf("%d %d\n",x,y);
}
