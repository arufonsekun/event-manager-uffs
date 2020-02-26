<template>
    <base-modal
        modalid="createEventModal"
        variant="dark"
        @create="createEvent"
    >
        <div class="form-group">
            <label for="eventName">Nome do evento</label>
            <input type="text" name="eventName" id="eventName" class="form-control">
        </div>

        <div class="form-group">
            <label for="eventPlace">Local do evento</label>
            <input type="text" name="eventPlace" id="eventPlace" class="form-control">
        </div>

        <div class="form-group">
            <label for="eventDescription">Breve descrição</label>
            <textarea name="eventDescription" id="eventDescription" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="eventDateStart">Data de início do evento</label>
            <input type="date" name="eventDateStart" id="eventDateStart" class="form-control">
        </div>

        <div class="form-group">
            <label for="eventDateEnd">Data de térmimo do evento</label>
            <input type="date" name="eventDateEnd" id="eventDateEnd" class="form-control">
        </div>

        <div v-if="hasErrors" class="alert alert-danger">
            <ol>
                <li v-for="error in errors">
                    {{ error[0] }}
                </li>
            </ol>
        </div>

    </base-modal>
</template>

<script>
export default {
    data() {
        return {
            "hasErrors" : false,
            "errors" : []
        }
    },
    methods: {
        async createEvent() {
            let data = {
                'name': document.getElementById('eventName').value,
                'place': document.getElementById('eventPlace').value,
                'description': document.getElementById('eventDescription').value,
                'start_date': document.getElementById('eventDateStart').value,
                'end_date': document.getElementById('eventDateEnd').value,
            }
            
            let successHandler = (response) => {
                console.log(response.response.data);
            }

            let errorHandler = (response) => {
                this.hasErrors = true;
                this.errors = response.response.data.errors;
                console.log(response.response.data);
            }

            await window.axios.post('/event', data)
            .then(successHandler)
            .catch(errorHandler);

            // window.location.replace('/editor');
        }
    }
}
</script>

<style lang="css" scoped>
</style>
