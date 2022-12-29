<script setup lang="ts">
import DataTable from 'datatables.net-vue3'
import array from '../page/Orders.vue'

console.log(array)
const data = [array]
</script>
 
<template>
	<div class="container">
		<DataTable :data="data" class="display" >
			<thead>
				<tr>
					<th>A</th>
					<th>B</th>
					<th>A</th>
				</tr>
			</thead>
		</DataTable>
	</div>
</template>

<style>
@import 'datatables.net-dt';
</style>