<template>
    <v-app id="register">
        <v-content>
            <v-container class="fill-height" fluid>
                <v-row align="center" justify="center">
                    <v-col cols="12" sm="8" md="4">
                        <v-card class="elevation-12">
                            <v-toolbar color="info" dark flat>
                                <v-toolbar-title>Register form</v-toolbar-title>
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
                                    
                                <v-form ref="form" v-model="valid">
                                    <v-text-field
                                        label="Name"
                                        name="Name"
                                        prepend-icon="mdi-account"
                                        type="text"
                                        v-model="name"
                                        required
                                        :rules="nameRules"
                                    />
                                    <v-text-field
                                        label="Email"
                                        name="email"
                                        prepend-icon="mdi-account"
                                        type="email"
                                        v-model="email"
                                        required
                                        :rules="emailRules"
                                    />

                                    <v-text-field
                                        id="password"
                                        label="Password"
                                        name="password"
                                        prepend-icon="mdi-lock"
                                        type="password"
                                        v-model="password"
                                        required
                                    />
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer />
                                <v-btn color="info" @click="register" :disabled="!valid" block>Register</v-btn>
                            </v-card-actions>
                        </v-card>
                        <v-snackbar v-model="snackbar">
                            {{ text }}
                            <v-btn color="pink" text @click="snackbar = false">Close</v-btn>
                        </v-snackbar>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            loading: false,
            snackbar: false,
            text: "",
            valid: true,
            emailRules: [
                v => !!v || "E-mail is required",
                v => /.+@.+\..+/.test(v) || "E-mail must be valid"
            ],
            nameRules: [
                v => !!v || "Name is required",
            ],
            passwordRules: [v => !!v || "E-mail is required"]
        };
    },
    methods: {
        register: async function() {
            console.log('here we go')
            this.loading = true;
            try {


                const requestOptions = {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ name: this.name, email: this.email, password: this.password })
                };

                const response = await fetch('/api/auth/register', requestOptions);
                const data = await response.json();     
                this.$refs.form.reset()
                 this.$router.push("/login");
            } catch (err) {
                console.log(err)
                this.loading = false;
               this.text = err.response.data.status;
                this.snackbar = true;
            }
        }
    }

};
</script>