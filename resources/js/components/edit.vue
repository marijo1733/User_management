<template>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous"
    />

    <v-app id="edit">
        <v-content>
            <v-container class="fill-height" fluid>
                <v-row align="center" justify="center">
                    <v-col cols="12" sm="8" md="4">
                        <v-card class="elevation-12">
                            <v-toolbar color="info" dark flat>
                                <v-toolbar-title>Edit User</v-toolbar-title>
                                <v-spacer />
                            </v-toolbar>
                            <v-card-text>
                                <v-progress-linear
                                    :active="loading"
                                    :indeterminate="loading"
                                    absolute
                                    top
                                    color="deep-purple accent-4"
                                ></v-progress-linear>

                                <v-form ref="form">
                                    <v-text-field
                                        label="Name"
                                        name="name"
                                        id="name"
                                        prepend-icon="mdi-account"
                                        type="text"
                                        required
                                        :rules="nameRules"
                                        v-model="form.name"
                                        v-bind:class="{
                                            'is-invalid': erorr.name,
                                        }"
                                    />
                                    <div
                                        v-if="erorr.name"
                                        class="invalid-feedback"
                                    >
                                        {{ erorr.name[0] }}
                                    </div>
                                    <v-text-field
                                        label="Email"
                                        name="email"
                                        id="email"
                                        prepend-icon="mdi-account"
                                        type="email"
                                        v-model="form.email"
                                        required
                                        :rules="emailRules"
                                        v-bind:class="{
                                            'is-invalid': erorr.email,
                                        }"
                                    />
                                    <div
                                        v-if="erorr.email"
                                        class="invalid-feedback"
                                    >
                                        {{ erorr.email[0] }}
                                    </div>
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <router-link to="/admin" class="m-2 btn btn-danger"
                                    >Cancel</router-link
                                >
                                <button
                                    type="submit"
                                    @click="StoreForm"
                                    class="btn btn-info"
                                >
                                    Submit
                                </button>
                            </v-card-actions>
                        </v-card>
                        <v-snackbar v-model="snackbar">
                            {{ text }}
                            <v-btn color="pink" text @click="snackbar = false"
                                >Close</v-btn
                            >
                        </v-snackbar>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>
<script>
import axios from 'axios';
import Swal from 'sweetalert2';
export default{
    props: ["id"],
    data() {
        return {
            form: {
                name: " ",
                email: " ",
            },
            option: [],
            erorr: [],
            data: {},
        };
    },
    methods:{
        getData() {
            const url = window.location.href;
            const lastParam = url.split("/").slice(-1)[0];
            const token = localStorage.getItem("token") || null;
            const headers = {
                Authorization: `Bearer ${token}`,
                "Content-Type": "application/json",
            };
            const config = {
                headers: headers,
            };
            axios
                .get("/api/auth/show/" + lastParam, config)
                .then((response) => {
                    this.form = {
                        name: response.data.name,
                        email: response.data.email,
                    };
                });
        },
        StoreForm(){
            try {
                const url = window.location.href;
            const lastParam = url.split("/").slice(-1)[0];
            const token = localStorage.getItem("token") || null;
            const headers = {
                Authorization: `Bearer ${token}`,
                "Content-Type": "application/json",
            };
            const config = {
                headers: headers,
            };
            let name = document.getElementById("name").value;
            let email = document.getElementById("email").value;

            const json = JSON.stringify({
                name: name,
                email: email,
            });
              axios
                .put("/api/auth/update/" + lastParam, json, {
                    headers: headers,
                })
                .then((response) => {
                console.log(response)
                Swal.fire(
                              "Updated!",
                              "User has been updated.",
                              "success"
                          );
                          this.$router.push( "/admin");
                })
                
            } catch (error) {
                this.error = error.response.data.errors;
            }
        
    }
    },
  

mounted() {
        this.getData();
    },
}
</script>
