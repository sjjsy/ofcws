#!/usr/bin/env python
#-*- coding: UTF-8 -*-


# Python
import os, sys

# Local
from settings import PROJECT_NAME, PROJECT_ROOT, PROJECT_LOG_ROOT, PROJECT_PID_ROOT
from mutils import sysrunrv, gpush, gpull, simple_arg_parser



## Custom functionalities
#

def set_perms( args=[] ):
	sysrunrv( 'find . -type d -exec chmod 755 "{}" \;' )
	sysrunrv( 'find . -type f -exec chmod 600 "{}" \;' )
	sysrunrv( 'chmod pgs/*php o+r' )
	sysrunrv( 'chmod data/gfx/*jpg o+r' )
	sysrunrv( 'chmod data/gfx/gallery/*jpg o+r' )
	return


def custom( args=[] ):

	return




## Main
#

if __name__ == '__main__':
	simple_arg_parser( globals(), sys.argv )




