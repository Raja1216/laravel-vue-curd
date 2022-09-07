<template>
  <div>

  <div class="login-box">
  <h2>Details</h2>
  <form>
    <div class="user-box">
      <input type="text" name="name" required="" v-model="item.name">
      <label>Name</label>
    </div>
    <div class="user-box">
      <input type="text" name="phone" required="" v-model="item.phone">
      <label>Phone</label>
    </div>
    <a @click='isEdit ? editDetails() : saveDtails()' >
      <span></span>
      <span></span>
      <span></span>
      <span></span>
     {{isEdit ? 'Update': 'Save'}}
    </a>
  </form>
</div>
<div class ="col-md-6 offset-md-3" v-if="lists.length > 0" style="margin-top:35rem">
  <h2 class="text-center">Accounts List</h2>
  <ul class="list-group">
    <li class="list-group-item" style="display:flex; justify-content:space-between"
    v-for="itm in lists">
   <span style="display:flex; gap:15px; align-items:center">
    <h4>{{itm.name}}</h4> <h6>{{itm.phone}}</h6></span>
    <span style="float:right">
    <button class= "btn btn-success btn-sm mr-2" type="button" @click='fieldUpdate(itm)'>Edit</button>
    <button class= "btn btn-danger btn-sm mr-2" type="button" @click='deleteDetails(itm.id)'>delete</button>
    </span>
    </li>
  </ul>
</div>

  </div>
</template>

<script>
export default {
  name: "accout-details",
  created() {},
  data() {

    return {
      lists:[],
      item:{
        name:'',
        phone:'',
      },
      temp_id : null,
      isEdit : false
    };
  },
  props: {},
  mounted() {
    this.getDetails();

  },
  methods: {
    saveDtails(){
      try {
        axios.post('/api/detail', this.item)
        .then(res => {
          this.item={};
          this.getDetails();
        })
      } catch (e) {
        console.log(e);
      }
    },
    getDetails(){
       try {
        axios.get('/api/detail', this.item)
        .then(res => {
          this.lists=res.data;
        })
      } catch (e) {
        console.log(e);
      }
    },
    deleteDetails(id){
      try {
        axios.delete(`/api/detail/${id}`)
        .then(res => {
          this.getDetails();
        })
      } catch (error) {
        console.log(error);
      }
    },
    fieldUpdate(itm){
       this.item={
        name:itm.name,
        phone:itm.phone,
      }
      this.isEdit=true;
      this.temp_id = itm.id
     
      console.log(this.temp_id);
    },
    editDetails(){
      // console.log(this.temp_id);
       try {
        axios.put(`/api/detail/${this.temp_id}`,this.item)
        .then(res => {
           this.getDetails();
        })
      } catch (error) {
        console.log(error);
      }
    }
  },
};
</script>

<style lang="scss" scoped>

body {
  margin:0;
  padding:0;
  font-family: sans-serif;
  background: linear-gradient(#141e30, #243b55);
}

.login-box {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  padding: 40px;
  transform: translate(-50%, -50%);
  background: rgba(0,0,0,.5);
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
  border-radius: 10px;
}

.login-box h2 {
  margin: 0 0 30px;
  padding: 0;
  color: #fff;
  text-align: center;
}

.login-box .user-box {
  position: relative;
}

.login-box .user-box input {
  width: 100%;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  margin-bottom: 30px;
  border: none;
  border-bottom: 1px solid #fff;
  outline: none;
  background: transparent;
}
.login-box .user-box label {
  position: absolute;
  top:0;
  left: 0;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  pointer-events: none;
  transition: .5s;
}

.login-box .user-box input:focus ~ label,
.login-box .user-box input:valid ~ label {
  top: -20px;
  left: 0;
  color: #03e9f4;
  font-size: 12px;
}

.login-box form a {
  position: relative;
  display: inline-block;
  padding: 10px 20px;
  color: #03e9f4;
  font-size: 16px;
  text-decoration: none;
  text-transform: uppercase;
  overflow: hidden;
  transition: .5s;
  margin-top: 40px;
  letter-spacing: 4px
}

.login-box a:hover {
  background: #03e9f4;
  color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 5px #03e9f4,
              0 0 25px #03e9f4,
              0 0 50px #03e9f4,
              0 0 100px #03e9f4;
}

.login-box a span {
  position: absolute;
  display: block;
}

.login-box a span:nth-child(1) {
  top: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, transparent, #03e9f4);
  animation: btn-anim1 1s linear infinite;
}

@keyframes btn-anim1 {
  0% {
    left: -100%;
  }
  50%,100% {
    left: 100%;
  }
}

.login-box a span:nth-child(2) {
  top: -100%;
  right: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(180deg, transparent, #03e9f4);
  animation: btn-anim2 1s linear infinite;
  animation-delay: .25s
}

@keyframes btn-anim2 {
  0% {
    top: -100%;
  }
  50%,100% {
    top: 100%;
  }
}

.login-box a span:nth-child(3) {
  bottom: 0;
  right: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(270deg, transparent, #03e9f4);
  animation: btn-anim3 1s linear infinite;
  animation-delay: .5s
}

@keyframes btn-anim3 {
  0% {
    right: -100%;
  }
  50%,100% {
    right: 100%;
  }
}

.login-box a span:nth-child(4) {
  bottom: -100%;
  left: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(360deg, transparent, #03e9f4);
  animation: btn-anim4 1s linear infinite;
  animation-delay: .75s
}

@keyframes btn-anim4 {
  0% {
    bottom: -100%;
  }
  50%,100% {
    bottom: 100%;
  }
}

</style>