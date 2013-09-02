#!/usr/bin/env python
#-*- coding: UTF-8 -*-


"""
  tool.py  :  easy management of your project: write less, do more!

    author:  smarisa
      date:  2013-02-09


  USAGE:  tool.py (FUNCTION ARG*)*
"""


# python
import os, sys

# local
from settings import PROJECT_NAME, ROOT, LOG_ROOT
from mutils import sysrunrv, gpush, gpull, simple_arg_parser



## Custom functionalities
#

def set_perms( args=[] ):
  """
    Sets the file permissions as they should be: maximizing security while
    allowing the required permissions in order for the site to function.
  """

  cmds = [
    'find . -type d -exec chmod 755 "{}" \;',
    'find . -type f -exec chmod 600 "{}" \;',
    'find ./pgs/                -maxdepth 1 -type f -name "*php" -exec chmod o+r "{}" \;',
    'find ./static/gfx/         -maxdepth 1 -type f -name "*jpg" -exec chmod o+r "{}" \;',
    'find ./static/gfx/gallery/ -maxdepth 1 -type f -name "*jpg" -exec chmod o+r "{}" \;',
    'find ./static/css/         -maxdepth 1 -type f -name "*css" -exec chmod o+r "{}" \;',
#    'find ./static/php/                     -type f              -exec chmod o+r "{}" \;',
    'find ./feed/               -maxdepth 1 -type f              -exec chmod o+r "{}" \;',
    'chmod o+r ./index.php',
    'chmod o+r ./favicon.ico',
#    'chmod u+x ./tool.py',
  ]

  for cmd in cmds:
    sysrunrv( cmd )

  return


def custom( args=[] ):
  """
    Custom temporary functionalities can be handily added here.
  """

  return




## Main
#

if __name__ == '__main__':
  simple_arg_parser( globals(), sys.argv )
