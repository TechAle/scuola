#include <stdio.h>
void modifica(int *x, int *y);
int main(void)
{
	int x,y;
	x=1;
	y=2;
	modifica(&x,&y);
	printf("%d %d\n",x,y);
	return 0;
}
void modifica(int *x, int *y)
{
	(*x)+=3;
	(*y)--;
}
