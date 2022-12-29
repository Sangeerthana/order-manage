<template>
{{orders}}
</template>

<script>
import fetchData from "../Function/Fetch.js"
export default {
  name:'Teammets',
	data() {
		return {
			orders: []
		}
	},
	created() {
		fetchData({
			url: '/get-user',
			success: (res) => {
				this.orders = res
			},
			error: (e) => {
				console.log(e)
			}
		})
	}
}
</script>