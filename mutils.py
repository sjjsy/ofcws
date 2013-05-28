#!/usr/bin/env python
#-*- coding: UTF-8 -*-


# python
import os, datetime
import time, shutil, subprocess, shlex

# local
from settings import ROOT, LOG_ROOT




## Logging
#

pflogcombined = os.path.join( LOG_ROOT, 'combined.log' )
pflogsysrun   = os.path.join( LOG_ROOT, 'sysrun.log' )


def add_log_row( pflog, s ):

	if not os.path.exists( pflog ):  omode = 'w'
	else:                            omode = 'a'

	with open( pflog, omode ) as pfdst:
		pfdst.write( datetime.datetime.now().strftime( '%Y-%m-%d %H:%M:%S.%f' ) + s + '\n' )


def log( pflog, items ):

	pflog_original = pflog

	if not os.path.isabs( pflog ):
		pflog = os.path.join( LOG_ROOT, pflog )

	if os.path.splitext( pflog )[1][1:] != 'log':  pflog += '.log'

	if type(items) != list:  items = [ items ]

	pdlog = os.path.dirname( pflog )

	if not os.path.exists( pdlog ):
		os.makedirs( pdlog )

	s = ''
	for itm in items:
		sitm = str(itm).replace( '\n', '\\n' )
		s += '\t%s' % ( sitm )

	add_log_row( pflog, s )
	add_log_row( pflogcombined, '\t' + pflog_original + s )


## System related functions
#

def sysrunrv( cmd, delay=0 ):
	print '> %s' % ( cmd )
	if delay > 0.0:  time.sleep( delay )
	log( pflogsysrun, [ 'CMD:', cmd ] )
	return subprocess.call( shlex.split( cmd ) )


def sysruno( cmd ):
	print '> %s' % ( cmd )
	log( pflogsysrun, [ 'CMD:', cmd ] )
	p = subprocess.Popen( cmd, shell=True, stdout=subprocess.PIPE )
	return p.stdout.read().strip()


## Git related functions
#

def gpush( args=[] ):

	if len(args) == 0:
		raise Exception, 'Commit description needed!'

	commit_description = args[0]

	print 'pushing the changes to the git repo server...'

	cmds = [
		'git status',
		'git add .',
		'git commit -m "%s" -a' % ( commit_description ),
		'git push origin master',
#		'git push --all -f',
	] # ssh://git@github.com/smarisa/wsdp.git

	log( pflogsysrun, 'GPUSH' )

	for cmd in cmds:
		rv = sysrunrv( cmd, delay = 2.0 )
		if rv != 0:
			raise Exception, 'Running |%s| failed!' % ( cmd )


def gpull( args=[] ):

	print 'pulling the changes from the git repo server...'

	cmds = [
		'git pull origin master',
	]  # --force

	log( pflogsysrun, 'GPULL' )

	for cmd in cmds:
		rv = sysrunrv( cmd, delay = 2.0 )
		if rv != 0:
			raise Exception, 'Running |%s| failed!' % ( cmd )


## RSS feed related
#

def update_rss_feed():
	"""
		http://www.dalkescientific.com/Python/PyRSS2Gen.html
	"""
	import datetime
	import PyRSS2Gen

	rss = PyRSS2Gen.RSS2(
	title = "Andrew's PyRSS2Gen feed",
	link = "http://www.dalkescientific.com/Python/PyRSS2Gen.html",
	description = "The latest news about PyRSS2Gen, a "
	"Python library for generating RSS2 feeds",

	lastBuildDate = datetime.datetime.now(),

	items = [
	PyRSS2Gen.RSSItem(
	title = "PyRSS2Gen-0.0 released",
	link = "http://www.dalkescientific.com/news/030906-PyRSS2Gen.html",
	description = "Dalke Scientific today announced PyRSS2Gen-0.0, "
	"a library for generating RSS feeds for Python.  ",
	guid = PyRSS2Gen.Guid("http://www.dalkescientific.com/news/"
	"030906-PyRSS2Gen.html"),
	pubDate = datetime.datetime(2003, 9, 6, 21, 31)),
	PyRSS2Gen.RSSItem(
	title = "Thoughts on RSS feeds for bioinformatics",
	link = "http://www.dalkescientific.com/writings/diary/"
	"archive/2003/09/06/RSS.html",
	description = "One of the reasons I wrote PyRSS2Gen was to "
	"experiment with RSS for data collection in "
	"bioinformatics.  Last year I came across...",
	guid = PyRSS2Gen.Guid("http://www.dalkescientific.com/writings/"
	"diary/archive/2003/09/06/RSS.html"),
	pubDate = datetime.datetime(2003, 9, 6, 21, 49)),
	])

	rss.write_xml(open("pyrss2gen.xml", "w"))




## Main
#

def simple_arg_parser( funcs, argv ):

	"""
		The code below provides execution access to the commandline to any
		function defined in the namespace of this module.

		The commandline used to execute this script is processed as shown by the
		following example:

			Suppose the name of this script is "myscript.py"
			Commandline: "./myscript.py foo bar --goo moo 123" causes the
			following functions executed if found:
				1)  myscript( ['foo', 'bar'] )
				2)  goo( ['moo', '123'] )
	"""

	help_text  =  '%s  :  a tool to help manage your project\n'\
	              '\n'\
	              '  USAGE:  %s ARG* (--FUNC [ARG]*)*\n'\
	              '\n'\
	              '   FUNC:  The function you wish to execute\n'\
	              '    ARG:  An argument you wish to pass to the respective function\n'\
	              '\n'\
	              '   Note:  Arguments not given after a --FUNC are given to a func\n'\
	              '          with the same name as this runnable.\n' % ( argv[0], argv[0] )

	sargs = argv[:]
	sargs[0] = '--' + os.path.splitext( os.path.basename( sargs[0] ) )[0]

	agrps = []
	agrp = []
	for arg in sargs:
		if arg.startswith( '--' ):
			agrp = [ arg[2:] ]
			agrps.append( agrp )
		else:
			agrp.append( arg )

	nothing_done = True

	for agrp in agrps:
		func = agrp[0]
		args = agrp[1:]
		if funcs.has_key( func ):
			if args:
				print '==> %s( %s )' % ( func, ', '.join( args ) )
				funcs[ func ]( args )
			else:
				print '==> %s()' % ( func )
				funcs[ func ]()
			nothing_done = False

	if nothing_done:
		print help_text
		return 1




