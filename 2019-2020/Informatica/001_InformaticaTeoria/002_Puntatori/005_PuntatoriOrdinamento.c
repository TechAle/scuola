/*
	Name: Puntatori ordinamento
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: passare due valori con due puntatori
*/
#include <stdio.h>
void modifica(int *pX, int *pY)
{
	if ( *pY < *pX )
	{
		int app = *pX;
		*pX = *pY;
		*pY = app;
	}
}

int main(void)
{
	int x = 5, y = 6;
	printf("%d %d\n",x,y);
	modifica(&x,&y);
	printf("%d %d\n",x,y);
}
