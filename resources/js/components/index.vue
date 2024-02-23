
<template>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons"
      rel="stylesheet"
    />
    <v-app id="">
        <v-content>
            <v-navigation-drawer v-model="sidebar" app>
                <v-list>
                  <v-list-tile
                    v-for="item in menuItems"
                    :key="item.title"
                    :to="item.path">
                    <v-list-tile-action>
                      <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>{{ item.title }}</v-list-tile-content>
                  </v-list-tile>
                </v-list>
              </v-navigation-drawer>

              <v-toolbar app>
                <span class="hidden-sm-and-up">
                  <v-toolbar-side-icon @click="sidebar = !sidebar">
                  </v-toolbar-side-icon>
                </span>
                <v-toolbar-title>
                  <router-link to="/" tag="span" style="cursor: pointer">
                    {{ appTitle }}
                  </router-link>
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items class="hidden-xs-only">
                  <v-btn
                    flat
                    v-for="item in menuItems"
                    :key="item.title"
                    :to="item.path">
                    <v-icon left dark>{{ item.icon }}</v-icon>
                    {{ item.title }}
                  </v-btn>
                </v-toolbar-items>
              </v-toolbar>

        <v-content>
            <v-container  >
                <v-row align="center" justify="center">
                    <v-col cols="12" sm="8" md="4">
                        <v-container fluid>
                            <v-layout row wrap>
                              <v-flex xs12 class="text-xs-center" mt-5>
                                <h1>Welcome to Awesome App</h1>
                              </v-flex> 
                            </v-layout>
                            <v-layout row wrap>
                                <v-flex xs12 sm6 offset-sm3 mt-3>
                                    <blockquote class="blockquote text-xs-center">
                                      It's a user  authentication with JWT
                                    </blockquote>
                                </v-flex>
                              </v-layout>
                          </v-container>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
           
        </v-content>
    </v-app>
</template>
<script>

export default {

  data(){
    return {
      appTitle: 'User Management',
      sidebar: false,
      menuItems: [
          { title: 'Register', path: '/register', icon: 'face' },
          { title: 'Login', path: '/login', icon: 'lock_open' }
     ]
    }
  },
};
</script>
