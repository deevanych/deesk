<template>
    <div class="row mb-5">
        <div class="col-12 block-header">
            <div class="row align-items-center">
                <h3 class="font-weight-bold col flex-grow-0 mb-0 mr-2">Метрики</h3>
                <perfect v-bind:settings="{suppressScrollY: true}"
                         class="col filter position-relative overflow-hidden">
                    <nav class="d-flex" ref="nav">
                        <li class="mx-3 d-inline-flex align-items-baseline">
                            <a href="#" @click.prevent="changeData" data-param="employee" data-value="day">День</a>
                        </li>
                        <li class="mx-3 d-inline-flex align-items-baseline">
                            <a href="#" class="active" @click.prevent="changeData" data-param="employee"
                               data-value="week">Неделя</a>
                        </li>
                        <li class="mx-3 d-inline-flex align-items-baseline">
                            <a href="#" @click.prevent="changeData" data-param="employee" data-value="month">Месяц</a>
                        </li>
                        <li class="mx-3 d-inline-flex align-items-baseline">
                            <a href="#" @click.prevent="changeData" data-param="employee"
                               data-value="quarter">Квартал</a>
                        </li>
                        <li class="mx-3 d-inline-flex align-items-baseline">
                            <a href="#" @click.prevent="changeData" data-param="employee" data-value="year">Год</a>
                        </li>
                    </nav>
                </perfect>
            </div>
        </div>
        <div class="col-12 block-content">
            <div class="row">
                <div class="col-3">
                    <metric v-bind:url="'/api/v1/metrics/issuesCount'" v-model="type" v-bind:color="'#eafdd6'"
                            v-bind:title="'Создано заявок'"></metric>
                </div>
                <div class="col-3">
                    <metric v-bind:url="'/api/v1/metrics/issuesCount'" v-model="type" v-bind:color="'#b1d5fd'"
                            v-bind:title="'Решено заявок'"></metric>
                </div>
                <div class="col-3">
                    <metric v-bind:url="'/api/v1/metrics/issuesCount'" v-model="type" v-bind:color="'#f8ffbf'"
                            v-bind:title="'Умерло мышей'"></metric>
                </div>
                <div class="col-3">
                    <metric v-bind:url="'/api/v1/metrics/issuesCount'" v-model="type" v-bind:color="'#ffcbcf'"
                            v-bind:title="'Улетело мужиков'"></metric>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Metric from './show';

    export default {
        data: function () {
            return {
                type: 'week',
            }
        },
        components: {
            metric: Metric,
        },
        methods: {
            changeData(event) {
                let self = this;
                self.type = event.target.dataset.value;
                $(self.$refs.nav).find('a').removeClass('active');
                $(event.target).addClass('active');
            },
        }
    }
</script>
