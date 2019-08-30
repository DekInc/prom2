class operarios{
    nombre;
    trabajosTotales;
    sanciones;
    estado = {
        "estadoEmp": 1,
        "RazonDespido": ""
    };
    Cal1;
    Cal2;
    Cal3;
    Cal4;
    Cal5;
    Prom;
    UltimaNota;

    constructor(nombre){
        this.nombre='Operador'+nombre;
        this.trabajosTotales=0;
        this.sanciones=0;
        this.estado.estadoEmp = 1;
        this.estado.RazonDespido = '';
        this.Cal1=0;
        this.Cal2=0;
        this.Cal3=0;
        this.Cal4=0;
        this.Cal5=0;
        this.Prom=0.00;
        this.UltimaNota = 0;
    }

    SetCal(){
        var nota = 0;
        var prob = (Math.random()*100)+1;
        if(prob<3){
            // probabilidad de obtener 1
            nota = 1;
            this.Cal1++;
            this.sanciones = this.sanciones +2;
            if(this.UltimaNota === 1){
                this.estado.estadoEmp = 0;
                this.estado.RazonDespido = 'Mala calificacion';
            }
        } else if(prob<7){
            // probabilidad de obtener 2
            nota = 2;
            this.Cal2++;
            this.sanciones++;
        } else if(prob<11) {
            // probabilidad de obtener 3
            nota = 3;
            this.Cal3++;
            this.sanciones++;
        } else if(prob<56){
            // probabilidad de obtener 4
            nota = 4;
            this.Cal4++;
        } else {
            // probabilidad de obtener 5
            nota = 5;
            this.Cal5++;
        }
        this.UltimaNota = nota;
        return nota;
    }
}

