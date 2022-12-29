<template>
	<section>
		<div class="card-container">
			<a-row style="margin-left:10px">
				<a-col :span="4">
					<h1>Date</h1>
					<a-select defaultValue="Month to date" class="dropdown_menu_4" v-model:value="selections.sel_date" @change="selectionChanged">
						<a-select-option class="dropdown_items" value="week"> Week to date - {{currentDate()}} </a-select-option>
						<a-select-option class="dropdown_items" value="month"> Month to date - {{currentDate()}} </a-select-option>
						<a-select-option class="dropdown_items" value="year"> Year to date - {{currentDate()}} </a-select-option>
					</a-select>
				</a-col>
				<a-col :span="4">
					<h1>Status</h1>
					<a-select placeholder="Your selection" class="dropdown_menu_4" v-model:value="selections.sel_status" @change="selectionChanged">
						<a-select-option v-for="status in allstatus" :key="status.status" :value="status.status" class="dropdown_items">
							{{ status.status }}
						</a-select-option>
        	</a-select>
				</a-col>
				<a-col :span="5">
					<h1>Channels</h1>
					<a-select placeholder="Your selection"  class="dropdown_menu_5" v-model:value="selections.sel_channel" @change="selectionChanged">
						<a-select-option v-for="channel in allchannel" :key="channel" :value="channel" class="dropdown_items">
						 <div v-if="channel.split('_')[0] == 'MAINCHANNEL'"><b>{{ channel.split('_')[1] }}</b></div>
                         {{ channel }}
						</a-select-option>
					</a-select>
				</a-col>
				<a-col :span="5">
					<h1>Flags</h1>
					<a-select placeholder="Your selection"  class="dropdown_menu_5" v-model:value="selections.sel_flag" @change="selectionChanged">
						<a-select-option v-for="flags in allflags" :key="flags.flags" :value="flags.flags" class="dropdown_items">
							{{ flags.flags }}
						</a-select-option>
					</a-select>
				</a-col>
				<a-col :span="4" style="text-align:right">
					<h1></h1>
					<!--<a-button class="btns">Apply</a-button>-->
				</a-col>

			</a-row>
		</div>

		<div class="total-order-summary">
			<a-row style="margin-left:10px">
				<a-col :span="4">
					<a-statistic title="Total Orders" :value="total_orders" style="margin-right: 50px" />
				</a-col>
				<a-col :span="4">
					<a-statistic title="Total Orders Quantity " :value="total_qty" style="margin-right: 50px" />
				</a-col>
				<a-col :span="4">
					<a-statistic title="Total Sales Quantity" :value="total_sales" style="margin-right: 50px" />
				</a-col>
				<a-col :span="4">
					<a-statistic title="Avg. units/order item" :value="avg_qty" style="margin-right: 50px" />
				</a-col>
				<a-col :span="4">
					<a-statistic title="Avg. sales/order item" :value="avg_sales" style="margin-right: 50px" />
				</a-col>
			</a-row>
		</div>
    <div class="graph-container">
      <a-row style="margin-left:10px">
				<a-col :span="11">
					<canvas id="compareQty" height="180"></canvas>
				</a-col>
				<a-col :span="11">
          <canvas id="compareSales" height="180"></canvas>
        </a-col>
			</a-row>
    </div>
	</section>
</template>

<script>
import fetchData from "../Function/Fetch.js";
import Chart from 'chart.js/auto';

export default{
  name: "App",
  data() {
		return {
			allstatus: [],
			allchannel: [],
			allflags: [],
      total_orders:'',
      total_qty:'',
      total_sales:'',
      avg_qty:'',
      avg_sales:'',
      selections:{},
      axis: {},
      chartgraphqty:''
    }
	},
	created() {
    fetchData({
			url: '/get-summary',
      method: 'POST',
      body: { dataobj: this.selections},
			success: (res) => {
				this.total_orders = res.count,
        this.total_qty = res.qty,
        this.total_sales = res.sales,
        this.avg_qty = (res.qty / res.tot_days).toFixed(2),
        this.avg_sales = (res.sales / res.tot_days).toFixed(2)
			},
			error: (e) => {
				console.log(e.message)
			}
		}),
    fetchData({
      url: '/get-graphdata',
      method: 'POST',
      body: { dataobj: this.selections},
      success: (res) => {
        this.axis = res;
        const qty = document.getElementById('compareQty');
        var chartgraphqty = new Chart(qty, {
          type: 'line',
          data: {
            labels: res.xaxis,
            datasets: [{
              label: 'This month so far',
              data: res.yaxis_this
            },
            {
              label: 'Last month',
              data: res.yaxis_lmonth
            },
            {
              label: 'Same month last year',
              data: res.yaxis_lyear
            }]
          },
          options: {
            scales: {
              y: {beginAtZero: true}
            },
            plugins: {
              title: {
                display: true,
                text: 'Units Ordered',
                padding: {
                    top: 20,
                    bottom: 20
                }
              }
              ,legend: {
                position: 'bottom',
              }
            }
          }
        });
        const sales = document.getElementById('compareSales');
        new Chart(sales, {
          type: 'line',
          data: {
            labels: res.xaxis,
            datasets: [{
              label: 'This month so far',
              data: res.yaxis_thiss
            },
            {
              label: 'Last month',
              data: res.yaxis_lmonths
            },
            {
              label: 'Same month last year',
              data: res.yaxis_lyears
            }]
          },
          options: {
            scales: {
              y: {beginAtZero: true}
            },
            plugins: {
              title: {
                display: true,
                text: 'Ordered Product Sales',
                padding: {
                    top: 20,
                    bottom: 20
                }
              }
              ,legend: {
                position: 'bottom',
              }
            }
          }
        });
      },
      error: (e) => {
        console.log(e.message)
      }
    }),
		fetchData({
			url: '/get-allstatus',
			success: (res) => {
				this.allstatus = res
			},
			error: (e) => {
				console.log(e.message)
			}
		}),
		fetchData({
			url: '/get-allchannel',
			success: (res) => {
				this.allchannel = res
			},
			error: (e) => {
				console.log(e.message)
			}
		}),
		fetchData({
			url: '/get-allflags',
			success: (res) => {
				this.allflags = res
			},
			error: (e) => {
				console.log(e.message)
			}
		})
	},
	methods: {
    currentDate() {
      const current = new Date();
      const date = `${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
      return date;
    },
    test()
    {
        alert("here");
        var newChart = this.chartgraphqty;
        newChart.data.datasets[0].data = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
        newChart.update();
    },
    selectionChanged() {
      fetchData({
        url: '/get-summary',
        method: 'POST',
        body: { dataobj: this.selections},
        success: (res) => {
          this.total_orders = res.count,
          this.total_qty = res.qty,
          this.total_sales = res.sales,
          this.avg_qty = (res.qty / res.tot_days).toFixed(2),
          this.avg_sales = (res.sales / res.tot_days).toFixed(2)
        },
        error: (e) => {
          console.log(e.message)
        }
      }),
      fetchData({
        url: '/get-graphdata',
        method: 'POST',
        body: { dataobj: this.selections},
        success: (res) => {
          this.axis = res;
          /*var newChart = this.chartgraphqty;
          newChart.data.datasets.data = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
          newChart.update();*/
        },
        error: (e) => {
          console.log(e.message)
        }
      })
      this.test();
	  }
  },
}

</script>

<style>
.card-container {
	margin-top: 10px;
	padding-bottom: 25px;
	width:98%;
	margin-left:1%;
	background-color:#d2ddde;
	border: 1px solid #e3eced;
}
.btns{
	background-color:#017a8c;
	color:white;
	padding:10px 25px 10px 25px;
	height:auto;
	font-size:12px;
	font-weight:bold;
}
.dropdown_menu_4
{
	min-width: 235px;
	background-color: white;
	color: black;
	font-size:15px;
	height: 30px;
}
.dropdown_menu_5
{
	min-width: 290px;
	background-color: white;
	color: black;
	font-size:15px;
	height: 30px;
}
.dropdown_items
{
	height: 25px;
	padding: 5px 5px 5px 5px;
}

.total-order-summary {
	margin-top: 2px;
	padding-bottom: 25px;
	width:98%;
	margin-left:1%;
	background-color:white;
	border: 1px solid #e3eced;
}

.graph-container {
	margin-top: 10px;
	padding-bottom: 25px;
	width:98%;
	margin-left:1%;
	background-color:#f5f9fa;
	border: 1px solid #e3eced;
}
.heading
{
	font-size: 18px;
	font-weight:bold;
}
</style>
