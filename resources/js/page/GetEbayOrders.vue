<template>
	<pre>
		{{orders}}
	</pre>
</template>

<script>
import fetchData from "../Function/Fetch.js"
export default {
	data() {
		return {
			orders: []
		}
	},
	created() {
		fetchData({
			url: '/get-ebay-orders',
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