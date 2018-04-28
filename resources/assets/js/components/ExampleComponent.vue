<template>

    <div class="container">
        <div class="row justify-content-center p-1">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>
                    <div class="card-body">
                        {{greeting}}, I'm an example vue.js component, {{message}}, {{ someFunction() }}, {{ someFunctionTwo() }}
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {

        props: ['message'],
        data() {
            return { //<-- Why do I need to return this?
                age: 80,
                greeting: 'Hello',
                dataFromApi: [],
                startDateTime: "",
                endDateTime: "",
            }
        },
        mounted() {

            console.log('Component mounted.');

            var self = this; //<-- Why define this as self?

            axios.get('/api/user')
                .then(function (response) {
                    console.log(response.data);
                    //self.dataFromApi = response.data;
                })
                .catch(function (error) {
                    console.log(error); //<- test this out.
                });

        },
        methods: {
            someFunction: function(){
                return this.dataFromApi.name;
            },
            someFunctionTwo: function(){
                return this.greeting + ' ' + (this.age * 40);
            },
            submitForm:function () {
                console.log(this.startDateTime);
            }
        }
    }
</script>
