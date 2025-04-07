function actualizarFechaYHora() {
    const ahora = new Date();

    // FECHA en formato YYYY-MM-DD
    const fecha = ahora.toISOString().slice(0, 10);
    document.getElementById('txtfecha').value = fecha;

    // HORA en formato HH:mm:ss
    const horas = ahora.getHours().toString().padStart(2, '0');
    const minutos = ahora.getMinutes().toString().padStart(2, '0');
    const segundos = ahora.getSeconds().toString().padStart(2, '0');
    const hora = `${horas}:${minutos}:${segundos}`;

    document.getElementById('txtsollama').value = hora;
}

// Ejecutamos al inicio
actualizarFechaYHora();

// Actualizamos cada segundo para que la hora esté viva
setInterval(actualizarFechaYHora, 1000);