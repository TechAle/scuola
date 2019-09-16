/*
	Name: Massimo Positivi
	Author: Condello Alessandro
	Date: 16/09/19 08:27
	Description: Data la parabola y=ax2+bx+c, definire tre funzioni per calcolarne i punti significativi: vertice, fuoco, intersezioni con gli assi. Le tre funzioni ricevono come parametri i coefficienti a,b,c, un’ascissa x e restituiscono il valore calcolato.
 */
#include <stdio.h>
#include <math.h>
#include <string.h>
#include <stdlib.h>
#define MAX 15
int main()
{
    // variables //
    char    funzione[MAX],
            app_funzione[MAX],
            a_f[MAX];
    int i;
    float
        val[3],
        V[2],
        F[2],
        Xv,
        Yv,
        D;
    // input function
    printf("input the function (es 2x^2+4x+4)");
    gets(funzione);
    /// analyze
    // loop for a-b-c
    // backup of original function
    strcpy(app_funzione, funzione);
    for(i=0;i<3;i++)
    {
        // take value
        val[i] = atoi(app_funzione);
        if(i!=2)
        {
            // take substring
            strcpy(a_f, app_funzione);
            strcpy(app_funzione, strstr(a_f, "+")+1);
        }
    }
    /// parabola formula
    // val[0] = a
    // val[1] = b
    // val[2] = c
    // f[0] -> x f[1] -> y
    // director b
    D = pow(val[1], 2) - 4*val[0]*val[2];
    // x = 0
    Xv = -(val[1]/(2*val[0]));
    // y = 0
    Yv = -(1+D)/4*val[0];
    // fire (?) parable
    F[0] = Xv;
    F[1] = (1-D)/4*val[0];
    // vertex
    V[0] = Xv;
    V[1] = -D/4*val[0];
    // output
    printf("Parabola\t%s:\na\t%.2f\nb\t%.2f\nc\t%.2f\nAsse X\t%.2f\nAsse y\t%.2f\nFuoco:\tx:%.2f y:%.2f\nVertice:\tx:%.2f y:%.2f\n",funzione,val[0],val[1],val[2],Xv,Yv,F[0],F[1],V[0],V[1]);
    
    
    

}
