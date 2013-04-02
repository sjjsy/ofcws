# ofcws

A very simple PHP website to serve the needs of Otaniemi Fight Club.


## Purpose

Designed to provide a platform for providing basic static information updated casually (interval of a few months) and direct visitors to more up to date sources for more precise and actual information.

A smarter website will replace this when deemed necessary. Do not invest too much time nor energy into this!


## Architecture

The architecture is a simple PHP hack. Each page includes a header and a footer file (pg-header.php, pg-footer.php) to wrap its content.


## For Webmasters

1.	Register into github, ask smarisa to add you as collaborator.
2.	Pull the repo into your system.
3.	For testing locally you need to configure host specific files such as settings.py. See the respective files at otax.
4. Update the ModLog below when you make changes.
5.	Make the changes always thus: you@yoursystem -> git@github -> ofc@otax -- this makes permission handling easier and safer
6. Always make sure the repo on github is the most up to date. Pull it on your system before editing.
7. In ofc@otax.ayy.fi there is a few commands at ~/bin that provide easy git use:
	* mgpush DESC  -- push your updates (no perms atm: do editing on yoursystem)
	* mgpull       -- pull the newest version
8. Read the "Purpose" section. Do not invest too much time here.
9. Contact your colleagues if you have any hesitations!


# ModLog:

*	2013-04-02 smarisa: Added a static RSS feed and a "related" page.
*	2013-02-09 smarisa: Added file permission management to tool.py.
*	2013-02-09 smarisa: Clarified the repo and the readme for collaborators.
*	2013-02-08 smarisa: Added google calendar integration and event listings.
*	2013-02-08 smarisa: Cleaned the repo and updated the readme.
*	2013-02-07 smarisa: Created the web site.




