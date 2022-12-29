<template>
	<div style="background: #ececec; padding: 30px">
		<h1>Add Channel</h1>
		{{getchannel}}
		<a-col :span="15">
			<a-input-group compact>
				<a-input 
					placeholder="Add channel"
					style="width: calc(100% - 200px)" 
					v-model:value="getchannel.channel"
				/>
				<a-button 
					type="primary"
					@click="storeChannel"
				>
					Add
				</a-button>
			</a-input-group>
		</a-col>
		<br>
		<a-col>
			<table id="customers" border="2">
				<tr>
					<th>#</th>
					<th>Channel</th>
					<th>Action</th>
				</tr>
				<tr>
					<td>klk;jk;</td>
					<td>j;jl;jl</td>
					<td>k;k;k;</td>
				</tr>
			</table>
		</a-col>
  </div>
</template>

<script>
import fetchData from '../function/fetch.js';

export default {
  name: 'AddChannel',
	data() {
		return {
			getchannel: {}
		}
	},
	created() {

	},
	methods: {
		storeChannel() {
			fetchData({
				url: '/add-item',
				method: 'POST',
				body: this.getchannel,
				success: (res) => {
					console.log(res)
				},
				error: (e) => {
					console.log(e.message)
				}
			})
		}
	}
}
</script>

<style>
h1{
	font-size: 1rem;
	padding: 10px;
}
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #282b28;
  color: white;
}
</style>