document.getElementById("archivo").addEventListener("change", function(e){
    let archivo = e.target.files[0];
    if(archivo){
        let alumnos = [];
        let lector = new FileReader();
        lector.readAsText(archivo);
        lector.onload = function(event){
            let contenido = event.target.result;
            contenido = contenido.replaceAll(/\s/g,'');
            contenido = contenido.replaceAll(/[\n\r]+/g,'');
            let tabla = document.createElement("table");
            contenido = contenido.split(";");
            for(i=0;i<contenido.length-1;i++){
                let fila = document.createElement("tr");
                let alumno = contenido[i].split(",");
                // for(x=0; x<alumno.length; x++){
                //     alumno[x] = alumno[x].replaceAll(/\s/g,'');
                //     alert(alumno[x]);
                // }
                let values = alumno[0]+","+alumno[1]+","+alumno[2]+","+alumno[3]+","+alumno[4]+","+alumno[5]+","+alumno[6]+",";
                for(x=7;x<alumno.length;x++){
                    values += "-"+alumno[x];
                }
                values += "/";
                alumnos.push(values);
                for(y=0;y<alumno.length;y++){
                    let cell = document.createElement("td");
                    cell.innerHTML = alumno[y];
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




