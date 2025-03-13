# Usar la imagen oficial de Python
FROM python:3.11.9

# Establecer el directorio de trabajo dentro del contenedor
WORKDIR /API

# Instalar dependencias del sistema necesarias para pyodbc
RUN apt-get update && apt-get install -y \
    unixodbc \
    unixodbc-dev \
    libsqlite3-dev \
    gcc \
    g++ \
    && rm -rf /var/lib/apt/lists/*

# Copiar el archivo de dependencias
COPY requeriments.txt requeriments.txt

# Instalar las dependencias de Python
RUN pip install --no-cache-dir -r requeriments.txt

# Copiar el resto de los archivos de la aplicación
COPY . .

#Exponer el puerto 5000
EXPOSE 5000

# Especificar el comando de inicio de la aplicación
CMD ["python", "mysqlConexionFiltro.py"]
