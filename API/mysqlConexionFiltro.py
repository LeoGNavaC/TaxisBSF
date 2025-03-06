from flask import Flask, jsonify, request
from flask_cors import CORS  
import pyodbc

app = Flask(__name__)
CORS(app)  # Habilita CORS para todas las rutas

# Configuración de conexión con SQL Server
server = '172.35.53.1'
database = 'SBO_CLUBDEGOLF'
username = 'sa'
password = 'Xamaisb0'
driver = '{ODBC Driver 17 for SQL Server}'

try:
    conn = pyodbc.connect(f'DRIVER={driver};SERVER={server};DATABASE={database};UID={username};PWD={password}')
    print("✅ Conexión a SQL Server exitosa")
except Exception as e:
    print(f"❌ Error de conexión: {e}")

@app.route('/socios', methods=['GET'])
def obtener_socio():
    try:
        query = request.args.get('q', '').strip()
        print(f"🔎 Buscando socio con número de acción: {query}")

        cursor = conn.cursor()
        
        # Filtrar para que los resultados empiecen con el número ingresado
        sql = "SELECT CardCode, CardName FROM V_ActiveBusinessPartners WHERE CardCode LIKE ? ORDER BY CardCode"
        cursor.execute(sql, (query + '%',))  

        socios = [{"CardCode": row[0], "CardName": row[1]} for row in cursor.fetchall()]
        print(f"📊 Resultados encontrados: {socios}")  
        return jsonify(socios)
    except Exception as e:
        print(f"❌ Error en la API: {e}")
        return jsonify({"error": str(e)})

if __name__ == '__main__':
    app.run(debug=True)
