import requests
from bs4 import BeautifulSoup
import sys

url = "http://www.footballsquads.co.uk/eng/2014-2015/faprem/tottenha.htm"
r = requests.get(url)

soup = BeautifulSoup(r.content)

cells = soup.find_all("td")

for cell in cells:
	# stduout encoding for Windows' console...
	print cell.text.encode(sys.stdout.encoding, errors='replace')