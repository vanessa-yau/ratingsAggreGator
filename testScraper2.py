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

teamToFetch = {
	"Arsenal":"arsenal",
	"Aston Villa": "avilla",
	"Burnley":"burnley",
	"Chelsea":"chelsea",
	"Crystal Palace":"cpalace",
	"Everton":"everton",
	"Hull City":"hullc",
	"Leicester City":"leiceste",
	"Liverpool":"liverpoo",
	"Manchester City":"mancity",
	"Manchester United":"manutd",
	"Queens Park Rangers":"qpr",
	"Southampton":"southam",
	"Stoke City":"stoke",
	"Sunderland":"sunder",
	"Swansea City":"swansea",
	"Tottenham Hotspur":"tottenha",
	"West Bromwich Albion":"wba",
	"West Ham United":"westham"
}

for key in teamToFetch:	
	# fetches next URL to scrape via teamToFetch dictionary
	url = "http://www.footballsquads.co.uk/eng/2014-2015/faprem/" + teamToFetch[1] + ".htm"
	r = requests.get(url)
	soup = BeautifulSoup(r.content)
	rows = soup.find_all("tr")

	# naming cols from the page, for a player
	cols = ["number", "name", "nat", "pos", 
	"height", "weight", "dob", "birth", "prevClub"]

	# holds player dictionaries 
	# i.e. list of player dicts
	players = []

	for row in rows:
		player = {}
		colIndex = 0

		# find all td elements
		for cell in row.find_all("td"):
			#row = [row.text.encode(sys.stdout.encoding, errors='replace')]
			# each column in row, add data to player dict
			player[cols[colIndex]] = cell.text  	
			# use the function to print utf-8 chars in names
			#specialPrint(cell.text)
			# increment colIndex so we can iterate through
			# my named columns in cols
			colIndex+=1

		# increment, scrape the next team URL	
		scrapeIndex+=1
		# add player object into players array
		# (players array of objects player)	
		players.append(player)

allTeams = {}
#allTeams{teamToFetch} = players

# dump the arrays into json format
# to be used for seeding
jsonPlayers = json.dumps(allTeams)
print jsonPlayers

# write the json into a .txt file
#with open('players.txt', 'w') as outfile:
#	json.dump(players, outfile)

