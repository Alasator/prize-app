<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button id="roll-prize" class="btn btn-primary" v-on:click.hide="getPrize">Получить приз</button>
                <h3>{{message}}</h3>

                <div v-if="type === 1">
                   <button id="convert-to-loyalty" class="btn btn-dark" v-on:click="convertToLoyalty">Обменять выигранные деньги на баллы лояльности?</button>
                </div>
                <div v-if="type === 1 || type === 2">
                    <button id="return-prize"  class="btn btn-warning" v-on:click="returnPrize">Можете отказаться от приза</button>
                </div>

                <div id="success">

                </div>
                </div>
            </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                message: '',
                value: null,
                type: null,
                status: null,
                id:null
            }
        },
        methods: {
            getPrize() {
                axios.get('/getprize').then(response => {
                    this.message = response.data.message;
                    this.value = response.data.value;
                    this.type = response.data.type;
                    this.id = response.data.id;
                    /*$('#roll-prize').hide();*/
                });
            },
            convertToLoyalty() {
                axios.post('/getloyalty',{value: this.value}).then(response => {
                    this.status = response.status;
                    this.message = response.data.message;
                    $('#convert-to-loyalty').hide();
                    $('#return-prize').hide();
                })
                    .catch(err => console.warn(err))
            },
            returnPrize() {
                axios.post('/returnprize',{id: this.id}).then(response => {
                    this.status = response.status;
                    this.message = response.data.message;
                    $('#return-prize').hide();
                    $('#convert-to-loyalty').hide();
                })
                    .catch(err => console.warn(err))
            }
        }
    }
</script>
