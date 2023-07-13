#include <stdio.h>

int main ()

{
int x ,y,z;
x=y=10;
z=++x;
x=-x;
y++;
x=x+y-(z--);

printf (" x = %d\n y = %d\n z = %d\n",x,y,z);
	
}











