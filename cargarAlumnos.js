document.getElementById("archivo").addEventListener("change", function(e){
    let archivo = e.target.files[0];
    if(archivo){
        let alumnos = [];
        let lector = new FileReader();
        lector.readAsText(archivo);
        lector.onload = function(event){
            let contenido = event.target.result;
            let tabla = document.createElement("table");
            contenido = contenido.split(";");
            for(i=0;i<contenido.length-1;i++){
                let fila = document.createElement("tr");
                let alumno = contenido[i].split(",");
                //let values = ""+alumno[0]+","+""+alumno[1]+","+""+alumno[2]+","+""+alumno[3]+","+""+alumno[4]+","+""+alumno[5]+","+""+alumno[6]+"/";
                let values = alumno[0]+","+alumno[1]+","+alumno[2]+","+alumno[3]+","+alumno[4]+","+alumno[5]+","+alumno[6]+"/";
                alumnos.push(values);
                for(x=0;x<alumno.length;x++){
                    let cell = document.createElement("td");
                    cell.innerHTML = alumno[x];
                    fila.appendChild(cell);
                }
                tabla.appendChild(fila);
            }
           
            document.body.appendChild(tabla);
            let request = new XMLHttpRequest();
            request.open("POST", "listadoAlumnos.php",true);
            request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            request.send("alumnos="+alumnos);
        }
    }
});




