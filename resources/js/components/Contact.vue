<template>
<html>
<div><h1 class="text-center">Control PC</h1>
<hr>
    <!-- botton modal para el editado de datos -->
    <button @click="update=false; openModal();" type="button" class="btn btn-primary">
      Nuevo Usuario
    </button>
    <!-- tGENERADOR DE EXCEL SIN TERMINAR :C -->
    <div class="row">
        <div class="col text-center">
          <a href="pdf.php">
            Generar XLS
          </a>
        </div>
      </div>
    <!-- Modal PRINCIPAL  -->
    <div class="modal" :class="{show:modal}">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{titleModal}}</h5>
            <button @click="closeModal();" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <div><!-- Modal para el editor de datos-->
             <label form="first_name">Usuario</label>
             <input v-model="contact.first_name" type="text" class="form-control" id="first_name" placeholder="Nombre Usuario">
              <label form="last_name">equipo</label>
             <input v-model="contact.last_name" type="text" class="form-control" id="last_name" placeholder="equipo">
              <label form="email">existencia</label>
             <input v-model="contact.email" type="text" class="form-control" id="email" placeholder="existencia">
            <label form="phone">bitacora</label>
             <input v-model="contact.phone" type="text" class="form-control" id="phone" placeholder="bitacora">
            <label form="address">caracteristica</label>
             <input v-model="contact.address" type="text" class="form-control" id="address" placeholder="caracteristicas">

           </div>
          </div><!-- cerrar modal-->
          <div class="modal-footer">
            <button @click="closeModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button @click="save();" type="button" class="btn btn-success">Guardar Cambios</button>
          </div>
        </div>
      </div>
    </div>
<table class="table table-striped table-hover">
  <thead>
    <tr> <!-- tabla de datos -->
      <th scope="col">#</th>
      <th scope="col">Usuario</th>
      <th scope="col">equipo</th>
      <th scope="col">existencia</th>
      <th scope="col">bitacora</th>
      <th scope="col">caracteristica</th>
      <th scope="col" colspan="2" class="text-center">Acción</th>
    </tr>
  </thead>
  <tbody><!-- tabla de datos  -->
    <tr v-for="contact in contact" :key="contact.id">
      <th scope="row">{{ contact.id }}</th>
      <td>{{ contact.first_name }}</td>
      <td>{{ contact.last_name }}</td>
      <td>{{ contact.email }}</td>
      <td>{{ contact.phone }}</td>
      <td>{{ contact.address }}</td>
      <td>
        <button  @click="update=true; openModal(contact);" class="btn btn-warning">Editar</button>
    </td>
     <td>
        <button @click="eliminar(contact.id)" class="btn btn-danger">Eliminar</button>
    </td>
  </tr>
  </tbody>
</table>
</div>
</html>
</template>

<script>
    export default  { //ventana para la creacion de datos
        data()  {
          return  {
            contact:{
              first_name:'usuario',
              last_name:'HP',
              email:'sin existencia',
              phone:'sin asignar',
              address:'equipo sin existencia en almacen',
            },
          id:0,
          update:true,
          modal:0,
          titleModal:' ',
          contacts:[],
          }
        }, //metodo para mostrar la lista de la tabla mysql en la appweb
    methods:  {
        async list()  {
        const res = await axios.get('contacts');
          this.contacs = res.data;
        },
    //metodo para eliminar 
    async eliminar(id)  {
        const res = await axios.delete('/contacts/' + id);
        //automatico delete para no presionar f5
        this.list();
            }
        },

        async save()  { //metodo guardar datos de nuevo y actualizar
        if (true.update){
            const res = await axios.put('/contacts'+ this.id, this.contact);
        }else{
          const res = await axios.post('/contacts', this.contact);

        }
        this.closeModal();
        this.list();
        },
        //modal para la modificacion de datos
        openModal(data={})  {
       this.modal=1;
       if(this.update){
         this.id=data.id,
         this.titleModal="modificar datos";
         this.contact.first_name = data.first_name;
         this.contact.last_name = data.last_name;
         this.contact.email = data.email;
         this.contact.phone = data.phone;
         this.contact.address = data.address;
       }else
       {
         this.id=0,
         this.titleModal="crear";
          this.contact.first_name='';
          this.contact.last_name='';
          this.contact.email='';
          this.contact.phone='';
          this.contact.address='';
         
       }
        },
        closeModal()  {
       this.Modal=0;
        },
        
        created(){
          this.list();

        },  

  }
</script>

  <!-- estilos-->
<style>.show
    {
      display: list-item;
      opacity:1;
      background: rgba(57, 39, 145, 0.849);
    }</style>
