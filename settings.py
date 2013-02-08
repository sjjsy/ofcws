#!/usr/bin/env python
#-*- coding: UTF-8 -*-


DEBUG = True


## Project
#

PROJECT_NAME             = 'ofc'
PROJECT_ROOT             = '/var/www/home/%s/' % ( PROJECT_NAME )
PROJECT_DATA_ROOT        = '/var/www/home/%s/data' % ( PROJECT_NAME )
PROJECT_LOG_ROOT         = '%s/logs' % ( PROJECT_DATA_ROOT )
PROJECT_PID_ROOT         = '%s/pids' % ( PROJECT_DATA_ROOT )
PROJECT_URL              = 'http://%s.ayy.fi' % ( PROJECT_NAME )
DATA_URL                 = 'http://%s.ayy.fi/data' % ( PROJECT_NAME )


## Admins and managers
#

MANAGERS = ADMINS = (
	( 'Samuel Marisa', 'samuel.marisa@cs.hut.fi' ),
)




