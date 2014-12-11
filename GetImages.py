import json
from queue import Queue
from threading import Thread
import unicodedata
import os

def getImages(queue):
    while True:
        url = queue.get()
        name = url
        #This needs changing to import pycurl
        try:
            #This will need modifying  depending on how you want to name the files
            os.system("cd magic && curl -L " + url + ' -O ' + name.replace('http://mtgimage.com/set/', '').replace('/', '-'))
        except OSError as e:
            print('error caught')
data = open('magicthegathering.json')
object = json.load(data)

q = Queue()
for i in range(5):
    thread = Thread(target=getImages, args=(q,))
    thread.setDaemon(True)
    thread.start()

for item in object:
    name= unicodedata.normalize('NFKD', item['name']).encode('ascii','ignore').decode('utf-8')
    url = 'http://mtgimage.com/set/' + item['serial_number']+ '/' + name.replace(' ', '%20').replace('\'', '') + '.jpg'
    q.put(url)

print('*** Main thread waiting ***')
q.join()
print('*** Done ***')
