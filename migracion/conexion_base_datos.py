from pymongo import MongoClient

client = MongoClient('mongodb://172.31.102.207:27017')
db = client['FerreteriaLuchito']
print(db.list_collection_names())
print("conexion exitosa")
