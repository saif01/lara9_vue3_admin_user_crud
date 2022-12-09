<template>
  <div>
    <div class="card">
      <div class="card-body">
        <table class="table">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
          <tr v-for="item in allData" :key="item.id">
            <td>{{ item.name }}</td>
            <td>{{ item.email }}</td>
            <td>Rifat</td>
            <td>
              <button
                class="btn btn-success text-dark"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal"
              >Test</button>
            </td>
          </tr>
        </table>
      </div>
    </div>

    <!-- modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crud</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form @submit.prevent="editmode ? updateData() : createData()">
            <div class="modal-body">
              <div class="form-group">
                <label for>Full Name</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Enter Your Name"
                  v-model="form.name"
                  :error-messages="form.errors.get('name')"
                />
              </div>

              <div class="form-group">
                <label for>Email</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Enter Your Email"
                  v-model="form.email"
                  :error-messages="form.errors.get('email')"
                />
              </div>

              <div class="form-group">
                <label for>Select Image</label>
                <input type="file" class="form-control" placeholder="Select Your Image" />
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary w-100" v-if="editMode">Update</button>
              <button type="submit" class="btn btn-primary w-100" v-else>Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "vform";
export default {
  data() {
    return {
      showModal: true,
      editmode: false,
      currentUrl: "/store",
      allData: "",
      form: new Form({
        name: "",
        email: "",
        image: ""
      })
    };
  },

  methods: {
    createData() {
      this.form.post(this.currentUrl + "/store").then(response => {
        console.log(this.reponse.data);
      });
    },

    updateData() {},

    getData() {
      axios.get(this.currentUrl + "/index").then(response => {
        this.allData = response.data;
      });
    }
  },

  created() {
    this.getData();
  }
};
</script>