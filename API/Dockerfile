# Usar la imagen oficial de Python como base
FROM python:3.11.9

# Establecer el directorio de trabajo dentro del contenedor
WORKDIR /API

# Instalar dependencias del sistema necesarias para pyodbc y el controlador ODBC de SQL Server
RUN apt-get update && apt-get install -y \
    unixodbc \
    unixodbc-dev \
    libsqlite3-dev \
    gcc \
    g++ \
    curl \
    apt-transport-https \
    gnupg \
    && mkdir -p /etc/apt/keyrings \
    && curl -sSL https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor -o /etc/apt/keyrings/microsoft.gpg \
    && chmod 644 /etc/apt/keyrings/microsoft.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/microsoft.gpg] https://packages.microsoft.com/debian/12/prod bookworm main" | tee /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql17 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


# Copiar el archivo de dependencias
COPY requeriments.txt .

# Instalar las dependencias de Python
RUN pip install --no-cache-dir -r requeriments.txt

# Copiar el resto de los archivos de la aplicación
COPY . .

# Exponer el puerto 5000 para Flask
EXPOSE 5000

# Especificar el comando de inicio de la aplicación
CMD ["python", "mysqlConexionFiltro.py"]
