<template>
  <div>
    <vheader></vheader>
    <vleftnav></vleftnav>
    <AddMaintain style="z-index:999999;" ref="addMaintain" />
    <DeleteDialog style="z-index:999999;" ref="deleteDialog" />

    <v-container class="fill-height" fluid style="padding=20px;">
      <v-main>
        <v-row>
          <v-col cols="3">
            <v-btn class="mb-10" block tile dark color="indigo" @click="OpenAddMaintainDialog(null)">
              Planifier une maintenance
              <v-icon
              right
              >
              mdi-calendar-edit
              </v-icon>
            </v-btn>
            <machine-filter 
              context="calendar" 
              selection="maintain" 
              @selectedDateChange="updateSelectedDate" 
              @selectedMachineIdChange="updateSelectedMachineId"
              ref="maintainAndFailure"
            ></machine-filter>
          </v-col>
          <v-col
            cols="9"
          >
            <div style="border-left: 1px solid gray; padding: 30px;">
              <template>
                <v-row class="fill-height">
                  <v-col>
                    <v-sheet height="64">
                      <v-toolbar
                        flat
                      >
                        <v-btn
                          outlined
                          class="mr-4"
                          color="grey darken-2"
                          @click="setToday"
                        >
                          Aujourd'hui
                        </v-btn>
                        <v-btn
                          fab
                          text
                          small
                          color="grey darken-2"
                          @click="prev"
                        >
                          <v-icon small>
                            mdi-chevron-left
                          </v-icon>
                        </v-btn>
                        <v-btn
                          fab
                          text
                          small
                          color="grey darken-2"
                          @click="next"
                        >
                          <v-icon small>
                            mdi-chevron-right
                          </v-icon>
                        </v-btn>
                        <v-toolbar-title v-if="$refs.calendar">
                          {{ $refs.calendar.title }}
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-menu
                          bottom
                          right
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-btn
                              outlined
                              color="grey darken-2"
                              v-bind="attrs"
                              v-on="on"
                            >
                              <span>{{ typeToLabel[type] }}</span>
                                <v-icon right>
                                  mdi-menu-down
                                </v-icon>
                            </v-btn>
                          </template>
                          <v-list>
                            <v-list-item @click="type = 'day'">
                              <v-list-item-title>Jour</v-list-item-title>
                            </v-list-item>
                            <v-list-item @click="type = 'week'">
                              <v-list-item-title>Semaine</v-list-item-title>
                            </v-list-item>
                            <v-list-item @click="type = 'month'">
                              <v-list-item-title>Mois</v-list-item-title>
                            </v-list-item>
                          </v-list>
                        </v-menu>
                      </v-toolbar>
                    </v-sheet>
                    <v-sheet height="600">
                      <v-calendar
                        ref="calendar"
                        v-model="focus"
                        color="grey lighten-2"
                        :weekdays="weekdays"
                        :weekday-format="localDayFormat"
                        :events="events"
                        :event-color="getEventColor"
                        :type="type"
                        @click:event="showEvent"
                        @click:more="viewDay"
                        @click:date="viewDay"
                      ></v-calendar>
                      <v-menu
                        v-model="selectedOpen"
                        :close-on-content-click="false"
                        :activator="selectedElement"
                        offset-x
                      >
                        <v-card
                          color="grey lighten-4"
                          min-width="350px"
                          flat
                        >
                          <v-toolbar
                            :color="selectedEvent.color"
                            dark
                          >
                            <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn icon @click="OpenAddMaintainDialog(selectedEvent.maintain)">
                              <v-icon>mdi-pencil-outline</v-icon>
                            </v-btn>
                            <v-btn icon @click="OpenDeleteDialog(selectedEvent.maintain)">
                              <v-icon>mdi-trash-can-outline</v-icon>
                            </v-btn>
                          </v-toolbar>
                          <v-card-text>
                            <span v-html="selectedEvent.details"></span>
                          </v-card-text>
                          <v-card-actions>
                            <v-btn
                              text
                              color="secondary"
                              @click="selectedOpen = false"
                            >
                              Fermer
                            </v-btn>
                          </v-card-actions>
                        </v-card>
                      </v-menu>
                    </v-sheet>
                  </v-col>
                </v-row>
              </template>
            </div>
          </v-col>
        </v-row>
      </v-main>
    </v-container>

    <vfooter></vfooter>
  </div>
</template>

<script>
/*
  Calendar page where the user can plan a new maintain and show all the planned maintains
*/

import AddMaintain from '../dialogs/AddMaintain'
import DeleteDialog from '../dialogs/DeleteDialog'

export default {
    components: {
      AddMaintain,
      DeleteDialog
    },
    data: () => ({
        showDialog: false,
        focus: '',
        type: 'month',
        typeToLabel: {
            month: 'Mois',
            week: 'Semaine',
            day: 'Jour',
        },
        weekdays: [1, 2, 3, 4, 5, 6, 0],
        selectedEvent: {},
        selectedElement: null,
        selectedOpen: false,
        events: [],
        maintains: [],
        maintainers: [],
        selectedMachineId: -1,
    }),
    mounted () {
      this.fetchMaintainers()     
      this.$refs.calendar.checkChange()
    },
    methods: {
      viewDay ({ date }) {
        // Day view mode
        this.focus = date
        this.type = 'day'
      },
      getEventColor (event) {
        return event.color
      },
      setToday () {
        this.focus = ''
      },
      prev () {
        // Previous day, week or month depending on the type
        this.$refs.calendar.prev()
      },
      next () {
        // Next day, week or month depending on the type
        this.$refs.calendar.next()
      },
      showEvent ({ nativeEvent, event }) {
        const open = () => {
          this.selectedEvent = event
          this.selectedElement = nativeEvent.target
          setTimeout(() => {
            this.selectedOpen = true
          }, 10)
        }

        if (this.selectedOpen) {
          this.selectedOpen = false
          setTimeout(open, 10)
        } else {
          open()
        }

        nativeEvent.stopPropagation()
      },
      updateCalendar() {
        const events = []

        this.maintains.forEach(maintain => {
          //add the event if it's machine is selected or if all machines are selected
          if(this.selectedMachineId === -1 || maintain.id_machine === this.selectedMachineId)
          {
            events.push({
              name: maintain.machine_name,
              details: this.getMaintainDetails(maintain.id_maintainer),
              start: new Date(maintain.planned_at),
              end: new Date(maintain.planned_at),
              color: 'indigo',
              maintain: maintain,
              timed: false,
            })
          }
        });

        this.events = events
      },
      OpenAddMaintainDialog(maintain) {
        this.selectedOpen = false
        this.$refs.addMaintain.show(maintain, this.maintainers)
      },
      OpenDeleteDialog(maintain) {
        this.$refs.deleteDialog.show(maintain,'/maintain_delete/')
      },
      localDayFormat(day) {
        switch(day.weekday) {
          case 0:
            return "Dimanche"
            break;
          case 1:
            return "Lundi"
            break;
          case 2:
            return "Mardi"
            break;
          case 3:
            return "Mercredi"
            break;
          case 4:
            return "Jeudi"
            break;
          case 5:
            return "Vendredi"
            break;
          case 6:
            return "Samedi"
            break;
        }
      },
      getMaintainDetails(id_maintainer){
        var maintainer = this.maintainers.find(x => x.id == id_maintainer)

        return "Maintenance attribuée à : <strong>" + maintainer.name + " " + maintainer.first_name + "</strong>"
      },
      fetchMaintains() {
        return new Promise((resolve, reject) => {
          axios.get("/maintains")
            .then(response => {
              this.maintains = response.data.maintains
              this.updateCalendar()
              this.$refs.maintainAndFailure.fetchItemsByMachine()
              resolve(response)
          })
          .catch(error => {
            reject(error)
          })
        })
      },
      fetchMaintainers() {
        return new Promise((resolve, reject) => {
          axios.get("/maintainers")
            .then(response => {
              this.maintainers = response.data.maintainers
              this.fetchMaintains()
              resolve(response)
          })
          .catch(error => {
            reject(error)
          })
        })
      },
      refresh(){
        this.fetchMaintainers()
        this.$refs.maintainAndFailure.fetchItemsByMachine()
      },
      updateSelectedMachineId(selectedMachineId) {
        this.selectedMachineId = selectedMachineId
        this.fetchMaintainers()
      },
      updateSelectedDate: function(selectedDate) {
        this.focus = selectedDate
      },
    }
  }
</script>