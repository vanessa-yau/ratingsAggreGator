# -*- coding: utf-8 -*-

# both for scraping
import requests
import urllib2
import urllib
from bs4 import BeautifulSoup
# just for console output - not needed in production
# <production>
from pprint import pprint # makes viewing the json nicer
import sys 
# </production>
import unicodedata
import json
# name of file to write to
json_data=open("app/storage/tottPlayers.json")

# load the json file
data = json.load(json_data)

for name in data:
	##name.encode('utf-8')
	name = name.replace(" ", "-")
	name = name.lower()
	# convert all the unicode characters into their ascii base chars
	unicodedata.normalize('NFKD', name).encode('ascii', 'ignore')
	url = "https://uk.eurosport.yahoo.com/football/players/" + name
	#url = "https://uk.eurosport.yahoo.com/football/players/hugo-lloris/"
	html = urllib2.urlopen(url)
	# scrape the player image for the url variable page
	r = requests.get(url)
	soup = BeautifulSoup(html)
	# find the image with class=photo
	imgs = soup.find_all('img', {'class':"photo"})
	# download the image
	#for img in imgs:
	urllib.urlretrieve(imgs, "C:/wamp/www/ratingsAggreGator/public/images/profile_images_testScrape/test.jpg")



json_data.close()


