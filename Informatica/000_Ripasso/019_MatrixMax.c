/*
	Name: MatriceMax
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Data una matrice, stampare:
 ¥ Il valore massimo e il valore minimo fra gli elementi di ciascuna riga;
 ¥ Il valore massimo e il valore minimo fra gli elementi di ciascuna colonna;
 ¥ Il valore massimo e il valore minimo fra tutti gli elementi
 */
#include <stdio.h>

#define MAX 3
int main()
{
    // variables //
    int Matr[MAX][MAX] =
    {
        {2,1,3},
        {2,15,4},
        {6,2,8}
    },
        i,
        max,
        min,
        var_r,
        var_c,
        mom;
    // max for row
    mom = var_r = var_c = 0;
    i = -1;
    max = min = Matr[0][0];
    /*
     mom means the moment:
     if 1-> row
     if 2-> coloumn
     if 3-> everything
     */
    for(mom=0;mom<MAX;mom++)
    {
        var_r = var_c = 0;
        for(i=0;i<MAX*MAX;i++)
        {
            // row count
            if(mom == 0)
            
                if (var_r < 2)
                
                    var_r++;
                else
                {
                    printf("colonna %d max %d min %d\n",var_c+1,max,min);
                    var_r = 0;
                    var_c++;
                    if(var_r != 3 && var_c != 3)
                        max = min = Matr[var_r][var_c];
                    else
                        max = min = Matr[0][0];
                }
            // coloumn count
            else if(mom == 1)
                
                if(var_c < 2)
                    var_c++;
                else
                {
                    printf("riga %d max %d min %d\n",var_r+1,max,min);
                    var_c = 0;
                    var_r++;
                    if(var_r != 3 && var_c != 3)
                        max = min = Matr[var_r][var_c];
                    else
                        max = min = Matr[0][0];
                }
            // if everything
            else
            
                if (var_r < 2)
                    
                    var_r++;
                else
                {
                    var_r = 0;
                    var_c++;
                }
            if(var_r != 3 && var_c != 3)
            ////// start max / min ////////
                if(max < Matr[var_r][var_c])
                    max = Matr[var_r][var_c];
                if(min > Matr[var_r][var_c])
                    min = Matr[var_r][var_c];
        }
        
            
    }
    printf("full max: %d full min: %d",max,min);
}







