/*
	Name: Puntatori passaggio (1-3) Void
	Author: Alessandro Condello
	Date: 01/10/19 08:54
	Description: passare due valori senza modifica
*/
#include <stdio.h>
void modifica(int x, int y)
{
	x++;
	y--;
}

int main(void)
{
	int x = 3, y = 4;
	printf("%d %d\n",x,y);
	modifica(x,y);
	printf("%d %d\n",x,y);
}
