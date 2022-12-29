<template>
	 <a-popover placement="rightTop" trigger="click">
		<a-button type="primary"> <FilterOutlined />Filter</a-button>
      <template #content>
				<a-tabs type="card" v-model:activeKey="activeKey">
					<a-tab-pane key="1" tab="Add New Filter">
						<a-row>
							<a-col :span="20">
								<a-space direction="vertical">
								<a-select 
									@change="thinu"
									v-model:value="value" 
									style="width:350px"
								>
									<a-select-opt-group label="Shipping">
										<a-select-option value="Shipping Services">Shipping Services</a-select-option>
										<a-select-option value="Shipping Total">Shipping Total</a-select-option>
										<a-select-option value="Shipping Date">Shipping Date</a-select-option>
									</a-select-opt-group>
									<a-select-opt-group label="Company">
										<a-select-option value="Yiminghe">Assign user</a-select-option>
										<a-select-option value="Yiminghe1">Flag</a-select-option>
									</a-select-opt-group>
									<a-select-opt-group label="Product">
										<a-select-option value="Yiminghe">Item title</a-select-option>
										<a-select-option value="Yiminghe1">Sku</a-select-option>
									</a-select-opt-group>
									
								</a-select>
								<a-select 
									style="width:350px"
									v-if = "selectValue == 'Shipping Services'"
								>
									<a-select-option value="Yiminghe">thinyu</a-select-option>
									<a-select-option value="Yiminghe">dnbjifdin</a-select-option>
									<a-select-option value="Yiminghe">bnfdb</a-select-option>
								</a-select>
							</a-space>
							</a-col>
						</a-row>
					</a-tab-pane>
					<a-tab-pane key="2" tab="Saved Filter">Content of Tab Pane 2</a-tab-pane>
				</a-tabs>
      </template>
    </a-popover>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';

import { 
	FilterOutlined, 
} from '@ant-design/icons-vue';

export default defineComponent({
	setup() {
    return {
      activeKey: ref('1'),
			value: ref(['Select Filter Type']),
    }
  },
  name: 'Filter',
	components: {
		FilterOutlined,
	},
	data() {
		return {
			selectValue: ''
		}
	},
	methods: {
		thinu(value){
			this.selectValue = value
      console.log(value)
    }
	}
})
</script>

<style>
.ant-popover-inner {
	width:400px;
}
.ant-tabs-tab {
 width:190px;
}
</style>