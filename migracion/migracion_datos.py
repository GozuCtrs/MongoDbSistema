from pymongo import MongoClient
import json

# Conectar a MongoDB (ajusta los detalles de la conexión)
client = MongoClient('mongodb://172.31.102.207:27017')  # Usa tu URL de conexión si es diferente
db = client['FerreteriaLuchito']

# Abre el archivo JSON con los datos
with open('FerreteriaLuchito.json', 'r') as f:
    data = json.load(f)

# Insertar los datos en las colecciones correspondientess
def insert_data():
    # Insertar cada tabla en la colección respectiva
    db.tipo_documento.insert_many(data["tipo_documento"])
    db.persona.insert_many(data["persona"])
    db.clientes.insert_many(data["clientes"])
    db.vendedores.insert_many(data["vendedores"])
    db.metodo_pago.insert_many(data["metodo_pago"])
    db.categoria.insert_many(data["categoria"])
    db.productos.insert_many(data["productos"])
    db.inventario.insert_many(data["inventario"])
    db.proveedores.insert_many(data["proveedores"])
    db.orden_movimiento_proveedor.insert_many(data["orden_movimiento_proveedor"])
    db.detalle_movimiento_proveedor.insert_many(data["detalle_movimiento_proveedor"])
    db.facturas_proveedor.insert_many(data["facturas_proveedor"])
    db.ordenes_compra.insert_many(data["ordenes_compra"])
    db.detalle_orden.insert_many(data["detalle_orden"])
    db.facturas.insert_many(data["facturas"])

# Llamada a la función para insertar los datos
insert_data()

print("Datos insertados correctamente.")
