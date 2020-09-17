/*
	Name: Puntatori passaggio (3-3) 1 puntatore
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: passare due valori con due puntatori
*/
#include <stdio.h>
int modifica(int *pX, int y)
{
	(*pX)++;
	y--;
	return y;
}

int main(void)
{
	int x = 3, y = 4;
	printf("%d %d\n",x,y);
	y = modifica(&x,y);
	printf("%d %d\n",x,y);
}
