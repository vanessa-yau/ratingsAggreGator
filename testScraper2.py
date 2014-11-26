import requests
from bs4 import BeautifulSoup
import sys
import json

def specialPrint(str):
	'''
	Function written because of
	stduout encoding for non-UTF8 console...
	see: 
	http://stackoverflow.com/questions/16346914/python-3-2-unicodeencodeerror-charmap-codec-cant-encode-character-u2013-i
	'''
	print str.encode(sys.stdout.encoding, errors='replace')

# names of the team in Premier League
teamName = [
"Arsenal",
"Aston Villa",
"Burnley",
"Chelsea",
"Crystal Palace",
"Everton",
"Hull City",
"Leicester City",
"Liverpool",
"Manchester City",
"Manchester United",
"Newcastle United",
"Queens Park Rangers",
"Southampton",
"Stoke City",
"Sunderland",
"Swansea City",
"Tottenham Hotspur",
"West Bromwich Albion",
"West Ham United",
]

# URLs to scrape player data from
teamsToScrape = [
# Arsenal
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/arsenal.htm",
# Aston Villa
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/avilla.htm",
# Burnley
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/burnley.htm",
# Chelsea
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/chelsea.htm",
# Crystal Palace
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/cpalace.htm",
# Everton
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/everton.htm",
# Hull City
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/hullc.htm",
# Leicester City
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/leicester.htm",
# Liverpool
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/liverpool.htm",
# Manchester City
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/mancity.htm",
# Manchester United
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/manutd.htm",
# Newcastle United
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/newcas.htm",
# Queens Park Rangers
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/qpr.htm",
# Southampton
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/southam.htm",
# Stoke City
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/stoke.htm",
# Sunderland
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/sunder.htm",
# Swansea City
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/swansea.htm",
# Tottenham Hotspur
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/tottenha.htm",
# West Bromwich Albion
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/wba.htm",
# West Ham United
"http://www.footballsquads.co.uk/eng/2014-2015/faprem/westham.htm"
]

for teamName in teamsToScrape:
	scrapeIndex = 0
	# fetches next URL to scrape via scrapeIndex
	url = teamsToScrape[scrapeIndex]
	r = requests.get(url)
	soup = BeautifulSoup(r.content)
	rows = soup.find_all("tr")

	cols = ["number", "name", "nat", "pos", 
	"height", "weight", "dob", "birth", "prevClub"]

	players = []

	for row in rows:
		player = {}
		colIndex = 0

		for cell in row.find_all("td"):
			#row = [row.text.encode(sys.stdout.encoding, errors='replace')]
			player[cols[colIndex]] = cell.text  	
			specialPrint(cell.text)
			colIndex+=1

		scrapeIndex+=1	
		players.append(player)

allPlayers = []
allPlayers[teamName] = players

jsonPlayers = json.dumps(allPlayers)
#print jsonPlayers

with open('players.txt', 'w') as outfile:
	json.dump(players, outfile)

