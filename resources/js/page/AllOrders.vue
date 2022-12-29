<template>
	<table border="2">
		{{orders}}
		<tr>
			<th>order ID</th>
			<th>order_status</th>
			<th>order_item_id</th>
			<th>order_quantity</th>
			<th>action</th>
		</tr>
		<tr v-for="newOrders in orders">
			<td>{{newOrders.order_id}} </td>
			<td>{{newOrders.order_status}}</td>
			<td>{{newOrders.order_item_id}}</td>
			<td>{{newOrders.order_quantity}}</td>
			<th>
				<a-button 
					type="default" 
					@click="showModal"
				>Export</a-button>
			</th>
		</tr>
	</table>

	<section>
		<!--Edit model-->
		<div>
			<a-modal 
				v-model:visible="visible" 
				title="Basic Modal" 
				@ok="handleOk"
			>
				<a-form>
					<div
						v-for="newOrders in orders">
						<a-input 
							v-model:value="newOrders.order_id"  
							placeholder="Basic usage" 
						/>
						
						<a-input 
							v-model:value="newOrders.order_id"  
							placeholder="Basic usage" 
						/>
						
						
						<a-input 
							v-model:value="newOrders.order_id"  
							placeholder="Basic usage" 
						/>
					</div>
				</a-form>
			</a-modal>
		</div>
		<!--Edit model-->
	</section>
</template>

<script lang="ts">
import fetchData from '../Function/Fetch';
import { defineComponent, ref } from 'vue';
export default defineComponent({
	name:'NewOrders',
	data(){
		return {
			orders: []
		}
	},
	created() {
		fetchData({
			url: '/get-orders',
			success: (res) => {
				this.orders = res
			},
			error: (e) => {
				console.log(e)
			}
		})
	},
	setup() {
		const visible = ref<boolean>(false)

		const showModal = () => {
			console.log('hudg')
      visible.value = true;
    }

		const handleOk = (e: MouseEvent) => {
      console.log(e);
      visible.value = false;
    }

		return {
			showModal,
			handleOk,
			visible,
		}
		
	},
	
		
})
</script>