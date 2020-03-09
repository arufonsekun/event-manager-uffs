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
            <label for="eventPlace">Local do evento</label>
            <input type="text" name="eventPlace" v-model="place" id="eventPlace" class="form-control">
        </div>

        <div class="form-group">
            <label for="eventDescription">Breve descrição</label>
            <textarea name="eventDescription" v-model="description" id="eventDescription" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="eventStartDate">Data de início do evento</label>
            <input type="date" name="eventStartDate" v-model="startDate" id="eventStartDate" class="form-control">
        </div>

        <div class="form-group">
            <label for="eventEndDate">Data de térmimo do evento</label>
            <input type="date" name="eventEndDate" v-model="endDate" id="eventEndDate" class="form-control">
        </div>

        <div :if="invalid">
            <ol>
                <li :for="error in errors">
                    {{ error[0] }}
                </li>
            </ol>
        </div>

    </base-modal>
</template>

<script>
export default {
    data: function() {
        return {
            name: '',
            place: '',
            description: '',
            startDate: '',
            endDate: '',
            invalid: false,
            error: '',
            errors : []
        }
    },
    methods: {
        async createEvent() {
            let data = {
                'name': this.eventName,
                'place': this.place,
                'description': this.description,
                'startDate': this.startDate,
                'endDate': this.endDate
            }

            console.log(data);

            var response = window.axios.post('/event', data);
            
            response.then((res) => {
                console.log(res.data);
            })
            .catch((err) => {
                
                err.response.data.errors.map((key) => {
                    console.log(key);
                });

                this.errors = err.response.data.errors;
            });
            
            
        }
    }
}
</script>

<style lang="css" scoped>
</style>
