<template>
	<section>
		<Nav></Nav>
	</section>
	<section style="margin-top:20px">
    <a-row 
			type="flex" 
			justify="end"
		>
      <a-col>
				<a-button 
					type="default"
					@click="showModalImport"
				>Import</a-button>
			</a-col>
      <a-col>
				<a-button 
					type="default" 
					@click="showModal"
				>Export</a-button>
			</a-col>
      <a-col>
				<a-button 
					type="default" 
					@click="showModalLarge"
				>Create order</a-button>
			</a-col>
      <a-col>
				<a-button 
					type="default"
				>Primary Button</a-button>
			</a-col>
    </a-row>
	</section>
	
	<section>
		<div class="card-container">
			<a-row style="margin-left:10px">
				<a-col :span="2">
					<h1>orders</h1>
				</a-col>
				<a-col :span="2">
					<h1>Manifests</h1>
				</a-col>
			</a-row>
			<a-row justify="end">
				<a-input placeholder="Basic usage" class="form-control" />
			</a-row>
			<a-tabs v-model:activeKey="activeKey" type="card">
				<a-tab-pane key="1" tab="New" class="thinu">	
					<Filter></Filter>
					<hr>
					<NewOrders></NewOrders>
				</a-tab-pane>
				<a-tab-pane key="2" tab="In progress">
					<Filter></Filter>
					<hr>
					<p>Content of Tab Pane 2</p>
					<p>Content of Tab Pane 2</p>
					<p>Content of Tab Pane 2</p>
				</a-tab-pane>
				<a-tab-pane key="3" tab="Dispatched">
					<Filter></Filter>
					<hr>
					<p>Content of Tab Pane 3</p>
					<p>Content of Tab Pane 3</p>
					<p>Content of Tab Pane 3</p>
				</a-tab-pane>
				<a-tab-pane key="4" tab="All">
					<Filter></Filter>
					<hr>
					<p>Content of Tab Pane 3</p>
					<p>Content of Tab Pane 3</p>
					<p>Content of Tab Pane 3</p>
				</a-tab-pane>
			</a-tabs>
		</div>
	</section>
	<!-- model section-->

	<section>
		<!--import model-->
		<div>
			<a-modal 
				v-model:visible="visible" 
				title="Basic Modal" 
				@ok="handleOk"
			>
				<p>Some contents...</p>
				<p>Some contents...</p>
				<p>Some contents...</p>
			</a-modal>
		</div>
		<!--import model-->

		<!--create order-->
		<template>
			<div>
				<a-modal
					v-model:visible="visibleLarge"
					title="Create manual order"
					@ok="createModelOk"
					width="100%"
					class="full-modal"
				>
					<div>
						<a-form>
							<a-row>
								<a-col :span="10">
									<a-label><b>Name</b></a-label>
									<a-input placeholder="Customer Name"></a-input>
								</a-col>
								<a-col :span="10" :offset="4">
									<a-label><b>Order id</b></a-label>
									<a-input placeholder="Order ID"></a-input>
								</a-col>
							</a-row>
							<br>
							<a-row>
								<a-col :span="10">
									<a-label><b>Company</b></a-label>
									<a-input placeholder="Company Name"></a-input>
								</a-col>
								<a-col :span="10" :offset="4">
										<a-label><b>Order Dtae</b></a-label>
										<a-input placeholder="Order ID"></a-input>
								</a-col>
							</a-row>
							<br>
							<a-row>
								<a-col :span="10">
									<a-label><b>Shipping Address</b></a-label>
									<a-input placeholder="Line1"></a-input>
								</a-col>
							</a-row>
							<br>
							<a-row>
								<a-col :span="10">
									<a-input placeholder="Line2"></a-input>
								</a-col>
							</a-row>
							<br>
							<a-row>
								<a-col :span="10">
									<a-input placeholder="City"></a-input>
								</a-col>
							</a-row>
							<br>
							<a-row>
								<a-col :span="10">
									<a-input placeholder="Country/state"></a-input>
								</a-col>
							</a-row>
							<br>
							<a-row>
								<a-col :span="10">
									<a-input placeholder="PostCode/Zip"></a-input>
								</a-col>
							</a-row>
							<br>
							<a-row>
								<a-col :span="10">
									<a-input placeholder="Country"></a-input>
								</a-col>
							</a-row>
							<br>
							<a-row>
								<a-col :span="10">
									<a-label><b>Phone Number</b></a-label>
									<a-input placeholder="Phone Number"></a-input>
								</a-col>
								<a-col :span="10" :offset="4">
									<a-label><b>Email</b></a-label>
									<a-input placeholder="Email address"></a-input>
								</a-col>
							</a-row>
							<br>
							<a-row>
								<a-col :span="10">
									<a-label><b>Shipping Services</b></a-label>
									<a-input placeholder="Shipping Services"></a-input>
								</a-col>
								<a-col :span="10" :offset="4">
									<a-label><b>Payment Method</b></a-label>
									<a-input placeholder="Payment Method"></a-input>
								</a-col>
							</a-row>
							<br>
							<hr>
							<a-row v-for="(input,k) in inputs" :key="k">
								<a-col :span="4">
									<a-label><b>Sku</b></a-label>
									<a-input placeholder="SKU"></a-input>
								</a-col>
								<a-col :span="10" :offset="1">
									<a-label><b>Description</b></a-label>
									<a-input placeholder="Description"></a-input>
								</a-col>
								<a-col :span="2" :offset="1">
									<a-label><b>Quantity</b></a-label>
									<a-input placeholder="Quantity"></a-input>
								</a-col>
								<a-col :span="3" :offset="1">
									<a-label><b>Unit Price</b></a-label>
									<a-input placeholder="Unit Price"></a-input>
								</a-col>
								<a-col :span="1">
									<br>
									<a-button 
										type="primary" 
										@click="add(k)" 
										v-show="k == inputs.length-1"
									><PlusOutlined /></a-button>
								</a-col>
								<a-col ::span="1">
									<br>
									<a-button 
										type="danger" 
										@click="remove(k)" 
										v-show="k || ( !k && inputs.length > 1)"
									><CloseOutlined /></a-button>
								</a-col>
							</a-row>
							<br>
							<a-row>
								<a-card 
									style="
									width: 100%;
									background: #F5F5F5;"
								>
									<a-row 
										type="flex" 
										justify="end"
									>
										<section>
											<a-row>
												<div style="margin-bottom: 16px">
													<a-input placeholder="Sub Total">
														<template  #addonBefore>
															<PoundCircleOutlined />
														</template>
													</a-input>
												</div>
											</a-row>
											<a-row>
												<div style="margin-bottom: 16px">
													<a-input placeholder="Shipping Paid">
														<template #addonBefore>
															<PoundCircleOutlined />
														</template>
													</a-input>
												</div>
											</a-row>
											<a-row>
												<div style="margin-bottom: 16px">
													<a-input placeholder="Order Total">
														<template #addonBefore>
															<PoundCircleOutlined />
														</template>
													</a-input>
												</div>
											</a-row>
										</section>
									</a-row>
								</a-card>
							</a-row>
						</a-form>
					</div>
				</a-modal>
			</div>
		</template>
		<!--create order-->

		<!--import modal-->
		<template>
			<div>
				<a-modal
					v-model:visible="importModelStatus"
					title="Import orders from a CSV file"
					@ok="createImportModelOk"
					width="100%"
					class="full-modal"
				>
					<div>
						<a-form>
							<a-row>
								<a-col :span="10">
									<a-button type="primary">Import CSV File</a-button>
								</a-col>
								<a-col :span="10" :offset="4">
									<a-alert
										message="Import orders from other platforms"
										description="CSV files allow you to transfer order data from one platform to another.Export a CSV file of orders from your platform and upload it here to import orders into Zenstores. To get started click 'Import a CSV file' and follow the instructions."
										type="info"
										show-icon
									/>
								</a-col>
							</a-row>
							<br>
								<hr>
							<br>
							<a-row>
								<a-card title="Default size card" style="width: 100%">
									<template #extra><a href="#">more</a></template>
									<p>card content</p>
									<p>card content</p>
									<p>card content</p>
								</a-card>
							</a-row>
							<br>
						</a-form>
					</div>
				</a-modal>
			</div>
		</template>
		<!--import modal-->

	</section>
	<!-- model section-->
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import Filter from '../page/Filter.vue'
import Nav from '../page/Nav.vue'
import NewOrders from '../page/AllOrders.vue'

import { 
	MailOutlined, 
	AppstoreOutlined, 
	SettingOutlined,
	DownloadOutlined,
	PlusOutlined,
	CloseOutlined,
	PoundCircleOutlined,
} from '@ant-design/icons-vue';

export default defineComponent({
  setup() {
		const current = ref<string[]>(['mail'])
		const visible = ref<boolean>(false)
		const visibleLarge = ref<boolean>(false)
		const importModelStatus = ref<boolean>(false)

		const showModal = () => {
      visible.value = true;
    }

		const handleOk = (e: MouseEvent) => {
      console.log(e);
      visible.value = false;
    }

		const showModalLarge = () => {
			console.log('busfrh')
      visibleLarge.value = true;
    }

		const createModelOk = (e: MouseEvent) => {
      console.log(e);
      visibleLarge.value = false;
    }

		const showModalImport = () => {
      importModelStatus.value = true;
    }

		const createImportModelOk = (e: MouseEvent) => {
      console.log(e);
      visibleLarge.value = false;
    }

    return {
      activeKey: ref('2'),
			current,
			visible,
			visibleLarge,
			importModelStatus,
			showModal,
      handleOk,
			createModelOk,
			showModalLarge,
			createImportModelOk,
			showModalImport
    }
  },
  components: {
		MailOutlined,
    AppstoreOutlined,
    SettingOutlined,
		DownloadOutlined,
		PlusOutlined,
		CloseOutlined,
		PoundCircleOutlined,
		Filter,
		Nav,
		NewOrders
	},
	data() {
		return {
			
			inputs: [
				{
					name: ''
				}
			]
		}
		
	},
	methods:{
		add(index) {
			this.inputs.push({ name: '' })
		},
		
		remove(index) {
			this.inputs.splice(index, 1)
		}
	}
});
</script>

<style>
.card-container {
	margin-top: 10px;
	/* height: auto; */
}
.card-container p {
  margin: 0;
	/* height: auto; */
}
.card-container > .ant-tabs-card .ant-tabs-content {
  height: 120px;
  margin-top: -16px;
	height: auto;
}
.ant-tabs-nav-list {
	margin-left: 10px;
}
.card-container > .ant-tabs-card .ant-tabs-content > .ant-tabs-tabpane {
  padding: 16px;
	margin-left: 10px;
	margin-right: 10px;
	background: white;
}
.card-container > .ant-tabs-card > .ant-tabs-nav::before {
  display: none;
}
.card-container > .ant-tabs-card .ant-tabs-tab,
[data-theme='compact'] .card-container > .ant-tabs-card .ant-tabs-tab {
	background: #C7C7C7;;
  /* border-color: transparent; */
	border-top-color: black;
	width:120px;
	font-size: 17px;
	padding: 17px 16px 20px 16px;
	min-width: 140px;
	margin-right: 0px;
	text-align: center;
	border: 0px !important;
	border-radius: 0px;
	font-family: "Lucida Console", "Courier New", monospace;
}
.card-container > .ant-tabs-card .ant-tabs-tab-active,
[data-theme='compact'] .card-container > .ant-tabs-card .ant-tabs-tab-active {
  background: #fff;
  border-color: #fff;
}
#components-tabs-demo-card-top .code-box-demo {
  padding: 24px;
  overflow: hidden;
  background: #f5f5f5;
	
}
[data-theme='compact'] .card-container > .ant-tabs-card .ant-tabs-content {
  height: 120px;
  margin-top: -8px;
}
[data-theme='dark'] .card-container > .ant-tabs-card .ant-tabs-tab {
  background: transparent;
  border-color: transparent;
}
[data-theme='dark'] #components-tabs-demo-card-top .code-box-demo {
  background: #000;
}
[data-theme='dark'] .card-container > .ant-tabs-card .ant-tabs-content > .ant-tabs-tabpane {
  background: #141414;
}
[data-theme='dark'] .card-container > .ant-tabs-card .ant-tabs-tab-active {
  background: #141414;
  border-color: #141414;
}
.form-control {
	display: block;
	width: 30%;
	height: 35px;
	padding: 6px 12px;
	font-size: 15px;
	line-height: 1.428571429;
	color: #555;
	background-color: #fff;
	background-image: none;
	border: 1px solid #BCBCBC;
	float: right;
}

.full-modal{
	max-width: 100%;
	top: 0;
	padding-bottom: 0;
	margin: 0;
}
.full-modal .ant-modal-content {
	display: flex;
	flex-direction: column;
	/* height: calc(100vh); */
	height: auto;
}
.ant-modal-body {
	padding-left:100px;
	padding-right:100px;
	flex: 1;
}
.ant-col {
	margin: 10px;
}
.thinu{
	height: auto;
}
</style>
