import requests

try:
  response = requests.get('http://catfacts-api.appspot.com/api/facts')
  cat_fact = response.json()
except:
  cat_fact['success'] == false

if cat_fact['success'] == 'true':
  print cat_fact['facts'][0]
else:
  print 'Error getting cat fact'
