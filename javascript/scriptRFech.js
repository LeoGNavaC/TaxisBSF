window.addEventListener('DOMContentLoaded', () => {
    // Obtener la fecha y hora del navegador
    const now = new Date();

    // Formatear fecha como yyyy-mm-dd
    const fecha = now.toISOString().split('T')[0];

    // Formatear hora como hh:mm:ss
    const hora = now.toTimeString().split(' ')[0];

    // Asignar a los inputs
    document.getElementById('txtfecha').value = fecha;
    document.getElementById('txtsollama').value = hora;
});
