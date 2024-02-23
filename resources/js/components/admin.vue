<template>
  <link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
  rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
  crossorigin="anonymous"
/>
  <v-app id="">
    <v-content>
      <div class="card mx-auto w-75">
        <div class="card-body">
            <!-- button atas -->
            <template>
                <v-toolbar flat>
                    <v-toolbar-title>Data</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" dark class="mb-2">
                    </v-btn>
                </v-toolbar>
            </template>
            <!-- end button atas -->
            <!-- header -->
            <v-card-title>
                <v-spacer></v-spacer>
                <!-- search engine -->
                <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details>
                </v-text-field>
            </v-card-title>
            <!-- end header -->
            <!-- table -->
            <v-data-table :headers="headers" :items="data" :search="search" :items-per-page="10" class="elevation-2">
                <!-- header table -->

                <!--  action icon di json nya -->
                <template v-slot:item.action="{ item }">
                    <v-icon @click="editUser(item)">mdi-pencil</v-icon>
                    <v-icon color="error" @click="deleteUser(item)"> mdi-delete</v-icon>
                </template>
                <!-- end -->
            </v-data-table>
        </div>

    </div>
    </v-content>
  </v-app>
 
</template>

<script>
import Swal from "Sweetalert2";
import axios from "axios";

export default {
  data() {
      return {
          headers: [
              {
                  text: "Name", // name header
                  value: "name", //   database value
              },
              {
                  text: "Email",
                  value: "email",
              },
              {
                  text: "Actions",
                  value: "action", // action
                  sortable: false,
                  align: "center",
              },
          ],
          data: [], //
          search: "",
          modelDelete: false,
      };
  },

  methods: {
      async GetData() {
          const token = localStorage.getItem("token") || null;
          const headers = {
              Authorization: `Bearer ${token}`,
              "Content-Type": "application/json", // You can adjust headers as needed
          };
          try {
              const response = await fetch("/api/auth/index", {
                  method: "GET",
                  headers: headers,
              });

              if (!response.ok) {
                  throw new Error("Failed to fetch data");
              }

              this.data = await response.json();
              console.log(this.data); // Do something with the fetched data
          } catch (error) {
              console.error("Error:", error);
          }
      },
      async deleteUser(item) {
          const token = localStorage.getItem("token") || null;
          const headers = {
              Authorization: `Bearer ${token}`,
              "Content-Type": "application/json", // You can adjust headers as needed
          };
          console.log(item.id);
          Swal.fire({
              title: "Are you sure ?",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes",
              cancelButtonText: "No",
          }).then((result) => {
              console.log(this.headers);
              if (result.isConfirmed) {
                  const config = {
                      headers: headers,
                  };

                  axios
                      .delete("/api/auth/user/" + item.id, config)
                      .then((response) => {
                          const idx = this.data.indexOf(item);
                          this.data.splice(idx, 1);

                          Swal.fire(
                              "Deleted!",
                              "User has been deleted.",
                              "success"
                          );
                      });
              }
          });
      },
      editUser(item) {
              this.$router.push('edit/' + item.id);
          },
  },

  mounted() {
      this.GetData();
  },
};
</script>

