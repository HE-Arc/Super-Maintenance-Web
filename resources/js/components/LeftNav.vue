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
                    <v-icon 
                      @click.stop="homeUrl"
                      v-bind="attrs" 
                      v-on="on"
                    >
                      mdi-home
                    </v-icon>    
                </template>
             
              <span>Accueil</span>
            </v-tooltip>
          </v-list-item-action>
        </v-list-item>

        <v-list-item>
          <v-list-item-action>
            <v-tooltip style="z-index:99999;" right>
                <template v-slot:activator="{ on, attrs }">   
                    <v-icon 
                      @click.stop="maintenanceUrl"
                      v-bind="attrs" 
                      v-on="on"
                    >
                      mdi-hammer-wrench
                    </v-icon>    
                </template>
            
              <span>Maintenance</span>
            </v-tooltip>
          </v-list-item-action>
        </v-list-item>

        <v-list-item>
          <v-list-item-action>
            <v-tooltip style="z-index:99999;" right>
                <template v-slot:activator="{ on, attrs }">   
                    <v-icon 
                      @click.stop="calendarUrl"
                      v-bind="attrs" 
                      v-on="on"
                    >
                      mdi-calendar-month
                    </v-icon>    
                </template>
            
              <span>Plannification</span>
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
    drawer: true,
  }),
  props: ['homeRoute'],
  methods: {
    homeUrl() {
      window.location.href = '/public'
    },
    maintenanceUrl() {
      window.location.href = '/public/maintenance'
    },
    calendarUrl() {
      window.location.href = '/public/calendar'
    }
  }
};
</script>