<template>
    <div class="row mt-3 mx-auto justify-content-around">
        <div class="col-md-3">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters border border-success">
                    <div class="col-md-4 bg-success">
                        <i class="fa fa-shopping-basket fa-3x my-3 d-block text-center" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-1 text-center">
                            <h3 class="card-title mb-1" v-text="daySale"></h3>
                            <p class="text-muted mb-1 "><small class="font-weight-bold">Ventas del Día</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters border border-warning">
                    <div class="col-md-4 bg-warning">
                        <i class="fa fa-line-chart fa-3x my-3 d-block text-center" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-1 text-center">
                            <h3 class="card-title mb-1" v-text="weekSale"></h3>
                            <p class="text-muted mb-1 "><small class="font-weight-bold">Ventas de la Semana</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters border border-info">
                    <div class="col-md-4 bg-info">
                        <i class="fa fa-money fa-3x my-3 d-block text-center" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-1 text-center">
                            <h3 class="card-title mb-1" v-text="moneySale"></h3>
                            <p class="text-muted mb-1 "><small class="font-weight-bold">Total del Día</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters border border-danger">
                    <div class="col-md-4 bg-danger">
                        <i class="fa fa-shopping-cart fa-3x my-3 d-block text-center" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-1 text-center">
                            <h3 class="card-title mb-1" v-text="dayOrder"></h3>
                            <p class="text-muted mb-1 "><small class="font-weight-bold">Compras del Día</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-3 mx-auto justify-content-around">
        <div class="col-md-5 bg-white">
            <PieChart :chartData="topData" :options="TopOptions"/>
        </div>
        <div class="col-md-5 bg-white">
            <BarChart :chartData="SalesData" :options="SaleOptions"/>
        </div>
    </div>
</template>
<script>
import { DoughnutChart, LineChart, PieChart, BarChart } from 'vue-chart-3';
import { Chart, ChartData, ChartOptions, registerables } from "chart.js";
import {computed, ref} from "vue";
Chart.register(...registerables);
export default {
    name:'ExampleComponent',
    components:{
        DoughnutChart,
        LineChart,
        PieChart,
        BarChart
    },
    setup(){
        const labelTop = ref([]);
        const dataTop = ref([]);
        const labelSale = ref([]);
        const dataSale = ref([]);
        const daySale = ref(0);
        const moneySale = ref(0);
        const weekSale = ref(0);
        const dayOrder = ref(0);

        const getData = async () => {
          let rsp = await axios.get('api/dashboard');
          labelTop.value = rsp.data.top.product;
          dataTop.value = rsp.data.top.total;
          labelSale.value = rsp.data.sales.month;
          dataSale.value = rsp.data.sales.total;
          daySale.value = rsp.data.day;
          weekSale.value = rsp.data.week;
          dayOrder.value = rsp.data.order;

        }

        const TopOptions = ref({
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Productos más Vendidos',
                },
            },
        });

        const topData =  computed(() => ({
            labels: labelTop.value,
            datasets: [
                {
                    label: 'Productos más vendidos',
                    data: dataTop.value,
                    backgroundColor: ['#E74C3C', '#8E44AD', '#3498DB', '#16A085', '#2ECC71','#F1C40F','#F39C12', '#34495E', '#AAB7B8', '#2980B9'],
                },
            ],
        }))

        const SaleOptions = ref({
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Ventas por mes',
                },
            },
        });
        const SalesData =  computed(() => ({
            labels: labelSale.value,
            datasets: [
                {
                    label: 'Ventas Totales',
                    data: dataSale.value,
                    backgroundColor: ['#F1C40F'],
                },
            ],
        }))

        getData();
        return{topData, TopOptions, SalesData, SaleOptions, daySale, weekSale, moneySale, dayOrder}
    }

}
</script>
