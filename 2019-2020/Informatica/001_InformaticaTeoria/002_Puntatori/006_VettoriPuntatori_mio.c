#include <stdio.h>

void set(int *vet)
{
	*(vet+1) = 1;
	vet[0] = 10;
}
/*
void set(int vet[])
{
	vet[0] = 10;
	*(vet+1) = 0;
}
*/
/*
void set(int vet[4])
{
	vet[0] = 10;
	*(vet+1) = 0;
}
*/

int main()
{
	int vet[] = {1,2,3,4};
	int *p = vet;
	int i;
	
	set(vet);
	
	//scanf("%d",p+1);
	/*
	scanf("%d",p[1]);
	scanf("%d",&(*(p+1)));
	*/
	
	for ( i = 0 ; i < 4 ; i++)
		printf("%d ",*(p+i));
		// printf("%d",p[i]);
		
		
}
