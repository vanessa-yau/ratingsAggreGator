# -*- coding: utf-8 -*-
import urllib2
from bs4 import BeautifulSoup
import sys
reload(sys)
sys.setdefaultencoding('utf-8')

url = 'http://www.footballsquads.co.uk/eng/2014-2015/faprem/tottenha.htm'
content = urllib2.urlopen(url).read()
soup = BeautifulSoup(content)

# prints out everything, .encode because it messes up on a unicode char
#print soup.prettify().encode(sys.stdout.encoding, errors='replace')

# print out the title
#print soup.title.string

# print out all the tds
for link in soup.find_all('td'):
	print(link)

# replaces unicode with '?'...
print soup.get_text()

# this prints fine
#print u"Stöcker".encode(sys.stdout.encoding, errors='replace')