<template>
	{{tabledata}}
	<a-table :columns="columns" :data-source="tabledata">
	  <template #headerCell="{ column }">
		<template v-if="column.key === 'name'">
		  <span>
			<smile-outlined />
			Name
		  </span>
		</template>
	  </template>
  
	  <template #bodyCell="{ column, record }">
		<template v-if="column.key === 'name'">
		  <a>
			{{ record.name }}
		  </a>
		</template>
		<template v-else-if="column.key === 'tags'">
		  <span>
			<a-tag
			  v-for="tag in record.tags"
			  :key="tag"
			  :color="tag === 'loser' ? 'volcano' : tag.length > 5 ? 'geekblue' : 'green'"
			>
			  {{ tag.toUpperCase() }}
			</a-tag>
		  </span>
		</template>
		<template v-else-if="column.key === 'opr'">
		  <span>
			<a>Invite</a>
			<a-divider type="vertical" />
			<a>Delete</a>
			<a-divider type="vertical" />
			<a class="ant-dropdown-link">
			</a>
		  </span>
		</template>
	  </template>
	</a-table>
  </template>
  <script lang="ts">
	import fetchData from "../Function/Fetch.js"
  import { SmileOutlined, DownOutlined } from '@ant-design/icons-vue';
  import { defineComponent } from 'vue';


  export default defineComponent({
	components: {
	  SmileOutlined,
	  DownOutlined,
	},
	setup() {
	  return {
			columns:[
				{
					name: 'Name',
					dataIndex: 'shippingaddresscity',
					key: 'shippingaddresscity',
				},
				{
					title: 'Age',
					dataIndex: 'shippingaddressregion',
					key: 'shippingaddressregion',
				}, {
					title: 'opr',
					key: 'opr'
				}
			],	
	  };
	},
	data() {
		return {
			tabledata: []
		}
	},
	created() {
		fetchData({
			url: '/test',
			success: (res) => {
				this.tabledata = res
			},
			error: (e) => {
				console.log(e)
			}
		})
	},
	methods: {

	}
  });
  </script>
  
  