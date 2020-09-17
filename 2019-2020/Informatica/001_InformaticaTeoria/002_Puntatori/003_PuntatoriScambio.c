/*
	Name: Puntatori scambio
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: passare due valori con due puntatori
*/
#include <stdio.h>
void modifica(int *pX, int *pY)
{
	int app = *pX;
	*pX = *pY;
	*pY = app;
}

int main(void)
{
	int x = 3, y = 4;
	printf("%d %d\n",x,y);
	modifica(&x,&y);
	printf("%d %d\n",x,y);
}
