new Vue({
  el: "#app",
  data: {
    url: "http://localhost:8080/Optica/",
    rut: "",
    recetas: [],
    receta: {},
    fecha: "",
  },
  methods: {
    buscarRut: async function () {
      var recurso = "controllers/BuscarRecetaXRut.php";
      var form = new FormData();
      form.append("rut", this.rut);
      try {
        const res = await fetch(this.url + recurso, {
          method: "post",
          body: form,
        });
        const data = await res.json();
        console.log(data);
        this.recetas = data;
      } catch (error) {
        console.log(error);
      }
    },
    buscarFecha: async function () {
      this.fecha=M.Datepicker.getInstance(buscar_fecha);
      var recurso = "controllers/BuscarRecetaXFecha.php";
      var form = new FormData();
      form.append("fecha", this.fecha);
      try {
        const res = await fetch(this.url + recurso, {
          method: "post",
          body: form,
        });
        const data = await res.json();
        console.log(data);
        this.recetas = data;
      } catch (error) {
        console.log(error);
      }
    },
    abrirModal: function (receta) {
      this.receta = receta;
      var modal = document.getElementById("modal1");
      var instance = M.Modal.getInstance(modal);
      instance.open();
    },
    generarPDF: function(id){
      //alert(id);
      window.open(this.url + "controllers/ExportarPDF.php?id=" + id, "_blank");  //_blank --> generar un nuevo tab
    },
  },
  created() {},
});


