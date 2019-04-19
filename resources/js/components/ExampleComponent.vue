<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>
                    <input type="text" v-model="name">
                    <div class="card-body">
                        my name : {{ name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
