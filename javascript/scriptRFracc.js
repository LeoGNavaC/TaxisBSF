function mostrarC() {
    const opcionFracc = document.getElementById("slFracc").value;
    const km  = document.getElementById("txtkm");
    const tag   = document.getElementById("sttag");
    const hoex  = document.getElementById("txthoex");
    const desc  = document.getElementById("txtdescuento");
    const lbKM  = document.getElementById("lbKM");
    const lbTAG  = document.getElementById("lbTAG");
    const lbHE  = document.getElementById("lbHE");
    const lbD  = document.getElementById("lbD");
    const sumaTotal = document.getElementById("sumaTotal");

    if (opcionFracc === "si"){//este los esconde
        $("#sumaTotal").attr("readonly",false);
        km.value    = "";
        tag.value   = "";
        hoex.value  = "";
        desc.value  = "";
        sumaTotal.value = "";
        km.style.display    = "none";
        tag.style.display   = "none";
        hoex.style.display  = "none";
        desc.style.display  = "none";
        lbKM.style.display  = "none";
        lbTAG.style.display = "none";
        lbHE.style.display  = "none";
        lbD.style.display   = "none";
    } else if (opcionFracc === "no"){//este no los esconde
        $("#sumaTotal").attr("readonly",true);//Modifica el valor de solo leer en la etiqueta
        km.value    = "";
        tag.value   = "";
        hoex.value  = "";
        desc.value  = "";
        sumaTotal.value = "";
        km.style.display    = "block";
        tag.style.display   = "block";
        hoex.style.display  = "block";
        desc.style.display  = "block";
        lbKM.style.display  = "block";
        lbTAG.style.display = "block";
        lbHE.style.display  = "block";
        lbD.style.display   = "block";
    }
};