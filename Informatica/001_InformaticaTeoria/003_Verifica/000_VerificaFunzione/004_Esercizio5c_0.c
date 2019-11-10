#include <stdio.h>
int Modifica(int y);
int main(void)
{
	int x, z;
	x = 4;
	z = Modifica(x);
	printf("%d %d\n",x,z);
	return 0;
}
int Modifica(int y)
{
	y *= 5;
	return ( --(y) );
}
