document.addEventListener("DOMContentLoaded", function () {
    const accionInput = document.getElementById("accion");
    const datalist = document.getElementById("lista-socios");
    const nombreSocioInput = document.getElementById("nombre-socio");

    accionInput.addEventListener("input", function () {
        const query = accionInput.value.trim();
        
        if (query.length < 2) {
            datalist.innerHTML = "";  // Si es muy corto, limpiamos la lista
            return;
        }

        fetch(`http://148.241.201.13:9500/socios?q=${query}`)
            .then(response => response.json())
            .then(data => {
                datalist.innerHTML = "";  // Limpiar opciones anteriores
                data.forEach(socio => {
                    let option = document.createElement("option");
                    option.value = socio.CardCode;  // Mostrar el número de acción
                    option.textContent = `${socio.CardCode} - ${socio.CardName}`;  
                    datalist.appendChild(option);
                });
            })
            .catch(error => console.error("Error al obtener los socios:", error));
    });

    // Evento cuando el usuario selecciona un valor
    accionInput.addEventListener("change", function () {
        let selectedOption = [...datalist.options].find(option => option.value === accionInput.value);
        if (selectedOption) {
            nombreSocioInput.value = selectedOption.textContent.split(" - ")[1] || ""; 
        }
    });
});
