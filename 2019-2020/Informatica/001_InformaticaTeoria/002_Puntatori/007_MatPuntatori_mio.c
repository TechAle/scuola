#include <stdio.h>
int main()
{
	int mat[3][3] = 
				{	{1,1,1},
					{2,2,2},
					{3,3,3}
				};
	int i,j;
	int *p = &mat[0][0];
	
	*(p) = 10;
	*(p+3) = 10;
	
	for(i = 0; i < 2; i++)
		scanf("%d",p+(i+1)*4);
	
	for(i = 0; i < 3; i++)
	{
		for(j = 0 ; j < 3; j++)
			printf("%d ",mat[i][j]);
		printf("\n");
	}
}
