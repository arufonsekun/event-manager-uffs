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
            <input type="date" name="startDate" v-model="startDate" id="startDate" class="form-control">
        </div>

        <div class="form-group">
            <label for="endDate">Data de térmimo do evento</label>
            <input type="date" name="endDate" v-model="endDate" id="endDate" class="form-control">
        </div>

        <div v-if="invalid">
            <div class="alert alert-danger">
                <ol>
                    <li v-for="error in errors">
                        {{ error[0] }}
                    </li>
                </ol>
            </div>
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
            errors : {
                '' : {}
            }
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

            console.log(data);

            var response = window.axios.post('/event', data);
            
            response.then(res => {

                console.log(res.data);

            })
            .catch(err => {
               
               this.errors = err.response.data.errors;
               this.invalid = true;

            });
            
            
        }
    }
}
</script>

<style lang="css" scoped>
</style>
