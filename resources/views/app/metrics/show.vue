<template>
    <div class="widget shadow-sm overflow-hidden position-relative" v-bind:value="value" :style="'background-color:'+color">
        <h5 class="font-weight-bold position-absolute m-4 mx-4 pl-2">{{ title }}</h5>
        <span class="count mx-4 pl-2 mt-4 text-secondary position-absolute">{{ count }}</span>
        <canvas ref="chart" class="metric-chart"></canvas>
        <PuSkeleton v-if="loading" class="position-absolute w-100 h-100 widget shadow-sm overflow-hidden"></PuSkeleton>
    </div>
</template>

<script>
    export default {
        props: ['value', 'title', 'data', 'url', 'color'],
        data: function(){
           return {
               count: 0,
               chart: null,
               loading: true,
           }
        },
        mounted() {
            let self = this;
            self.changeData();
        },
        watch: {
            value () {
                let self = this;
                self.changeData();
            }
        },
        methods: {
            changeData() {
                let self = this,
                    url = new URL(window.location.origin + self.url);
                url.searchParams.append('period', self.value);
                header.loading = true;
                self.loading = true;
                let ctx = self.$refs.chart.getContext('2d');
                if (self.chart) {
                    self.chart.destroy();
                }
                axios.get(url.href)
                    .then(function (response) {
                        header.loading = false;
                        let values = [],
                            issueCount = 0;
                        for (const [key, value] of Object.entries(response.data)) {
                            issueCount = issueCount + value;
                            values.push(value + 2);
                        }
                        self.count = issueCount;
                        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
                        gradient.addColorStop(0, 'rgba(176,107,179,1)');
                        gradient.addColorStop(0.3, 'rgba(176,107,179,0)');
                        self.chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: Object.keys(response.data),
                                datasets: [{
                                    backgroundColor: gradient,
                                    borderColor: '#8269c5',
                                    data: values,
                                }]
                            },
                            options: {
                                layout: {
                                    padding: {
                                        left: 0,
                                        right: 0,
                                        top: 10,
                                        bottom: 0
                                    }
                                },
                                maintainAspectRatio: true,
                                aspectRatio: 2,
                                elements: {
                                    point: {
                                        radius: 0, hitRadius: 10, hoverRadius: 10
                                    }
                                },
                                legend: {
                                    display: false
                                },
                                tooltips: {
                                    callbacks: {
                                        label: function (tooltipItem) {
                                            return (tooltipItem.yLabel - 2).toString();
                                        }
                                    }
                                },
                                animation: {
                                    onProgress: function(animation) {
                                        self.loading = false;
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        display: false,
                                        ticks: {
                                            beginAtZero: true
                                        },
                                        gridLines: {
                                            display: false,
                                        },
                                    }],
                                    xAxes: [{
                                        display: false,
                                        ticks: {
                                            beginAtZero: true
                                        },
                                        gridLines: {
                                            display: false,
                                        }
                                    }]
                                }
                            }
                        });
                    });
            }
        }
    }
</script>

<style scope>
    .widget {
        height: 200px;
        border-radius: 1rem;
        z-index: 1;
    }

    .metric-chart {
        z-index: 1;
        position: absolute;
        bottom: 0;
    }

    .widget .count {
        font-size: 6rem;
        opacity: .5;
    }
</style>
