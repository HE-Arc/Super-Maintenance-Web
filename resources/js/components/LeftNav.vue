<template>
  <div>
   <v-navigation-drawer
      mini-variant
      mini-variant-width="56"
      link
      permanent
      v-model="drawer"
      app
      clipped
    >
      <div class="my-2">
        <v-list-item>
          <v-list-item-action>
            <v-tooltip style="z-index:99999;" right>
              <template v-slot:activator="{ on, attrs }">
                <v-icon v-bind="attrs" v-on="on">
                  mdi-refresh
                </v-icon>
              </template>
              <span>Rafraichir le tableur</span>
            </v-tooltip>
          </v-list-item-action>
        </v-list-item>

        <v-list-item>
          <v-list-item-action>
            <v-tooltip style="z-index:99999;" right>
              <template v-slot:activator="{ on, attrs }">
                <v-icon
                  @click.stop="showStudentsDialog = true"
                  v-bind="attrs"
                  v-on="on"
                >
                  mdi-account-multiple-plus-outline
                </v-icon>
              </template>
              <span>Ajouter les étudiants</span>
            </v-tooltip>
          </v-list-item-action>
        </v-list-item>

        <v-list-item>
          <v-list-item-action>
            <v-tooltip style="z-index:99999;" right>
              <template v-slot:activator="{ on, attrs }">
                <v-icon
                  @click.stop="showMailDialog = true"
                  v-bind="attrs"
                  v-on="on"
                >
                  mdi-email-send-outline
                </v-icon>
              </template>
              <span>Envoyer les emails</span>
            </v-tooltip>
          </v-list-item-action>
        </v-list-item>

        <v-divider></v-divider>

        <v-list-item>
          <v-list-item-action>
            <v-tooltip style="z-index:99999;" right>
              <template v-slot:activator="{ on, attrs }">
                <v-icon v-bind="attrs" v-on="on">
                  mdi-folder-open-outline
                </v-icon>
              </template>
              <span>Charger une évaluation</span>
            </v-tooltip>
          </v-list-item-action>
        </v-list-item>

        <v-list-item>
          <v-list-item-action>
            <v-tooltip style="z-index:99999;" right>
              <template v-slot:activator="{ on, attrs }">
                <v-icon v-bind="attrs" v-on="on">
                  mdi-content-save-outline
                </v-icon>
              </template>
              <span>Sauvegarder l'évaluation</span>
            </v-tooltip>
          </v-list-item-action>
        </v-list-item>

        <v-divider></v-divider>

        <v-list-item>
          <v-list-item-action>
            <v-tooltip style="z-index:99999;" right>
              <template v-slot:activator="{ on, attrs }">
                <v-icon
                  @click.stop="showHelpDialog = true"
                  v-bind="attrs"
                  v-on="on"
                >
                  mdi-help-circle-outline
                </v-icon>
              </template>
              <span>Aide</span>
            </v-tooltip>
          </v-list-item-action>
        </v-list-item>
      </div>
    </v-navigation-drawer>
  </div>
</template>

<script>
export default {

  data: () => ({
    drawer: true
  }),
};
</script>