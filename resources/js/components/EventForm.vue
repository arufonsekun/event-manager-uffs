<template>
    <base-modal
        modal-id="createEventModal"
        modal-title="Criar Novo Evento"
        variant="dark"
        @create="createEvent"
    >
        <div class="form-group">
            <label for="name">Nome do evento</label>
            <input type="text" name="name" v-model="name" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="place">Local do evento</label>
            <input type="text" name="place" v-model="place" id="place" class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Breve descrição</label>
            <textarea name="description" v-model="description" id="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="startDate">Data de início do evento</label>
            <datepicker :language="pt" :format="dateFormat" name="startDate" v-model="startDate" :bootstrap-styling="true"></datepicker>
            <!--<input type="date" name="startDate" v-model="startDate" id="startDate" class="form-control">-->
        </div>

        <div class="form-group">
            <label for="endDate">Data de térmimo do evento</label>
            <datepicker :language="pt" :format="dateFormat" name="endDate" v-model="endDate" :bootstrap-styling="true"></datepicker>
            <!--<input type="date" name="endDate" v-model="endDate" id="endDate" class="form-control">-->
        </div>

        <div v-if="error">
            <div class="alert alert-danger">
                <ol>
                    <li v-for="error in response">
                        {{ error[0] }}
                    </li>
                </ol>
            </div>
        </div>

        <div v-if="success">
            <div class="alert alert-success">
                {{ response.message }}
            </div>
        </div>

    </base-modal>
</template>

<script>

import Datepicker from 'vuejs-datepicker';
import ptBR from 'vuejs-datepicker/dist/locale';
import moment from 'moment';

export default {
    data: function() {
        return {
            name: '',
            place: '',
            description: '',
            startDate: '',
            endDate: '',
            error: false,
            success: false,
            response : {},
            pt : ptBR
        }
    },
    methods: {
        async createEvent() {
            let data = {
                name: this.name,
                place: this.place,
                description: this.description,
                start_date: this.startDate,
                end_date: this.endDate
            }

            var response = window.axios.post('/event', data);
            
            response.then(res => {

                this.response = res.data;
                this.error = false;
                this.success = true;

                setTimeout(() => {
                    window.location.href = this.response.route;
                }, 2000);

            })
            .catch(err => {
               
               this.response = err.response.data.errors;
               this.error = true;
               this.success = false;

            });
        },
        dateFormat(date) {
            return moment(date).format('DD/MM/YYYY');
        }
    },
    components: {
        Datepicker
    }
}
</script>

<style lang="css" scoped>
</style>
