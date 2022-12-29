<template>
  <a-row>
		<a-col :span="10">
			Connect a store
			<a-dropdown>
				<template #overlay>
					<a-menu @click="handleMenuClick">
						<a-menu-item key="1">
							<UserOutlined />
							1st menu item
						</a-menu-item>
						<a-menu-item key="2">
							<UserOutlined />
							2nd menu item
						</a-menu-item>
						<a-menu-item key="3">
							<UserOutlined />
							3rd item
						</a-menu-item>
					</a-menu>
				</template>
				<a-button type="primary">
					Button
					<DownOutlined />
				</a-button>
			</a-dropdown>
		</a-col>
		<a-col :span="10">
			<a-alert
				message="Connect a store to import orders"
				description="If you sell on eBay, Amazon, Shopify or other web stores then your orders can be automatically imported in Zenstores."
				type="info"
				show-icon
			/>
		</a-col>
	</a-row>
	<hr>
	<a-row>
		<a-card 
			style="
				width: 800px; 
				height: auto; 
				background: #F5F5F5;"
		>
			<p>card content</p>
			<p>card content</p>
			<p>card content</p>
		</a-card>
	</a-row>
	<a-row>
		<a-card 
			style="
				width: 800px; 
				height: auto; 
				background: #F5F5F5;"
		>
			<p>card content</p>
			<p>card content</p>
			<p>card content</p>
		</a-card>
	</a-row>
	<a-row>
		<a-card 
			style="
				width: 800px; 
				height: auto; 
				background: #F5F5F5;"
		>
			<p>card content</p>
			<p>card content</p>
			<p>card content</p>
		</a-card>
	</a-row>
	<a-row>
		<a-card 
			style="
				width: 800px; 
				height: auto; 
				background: #F5F5F5;"
		>
			<p>card content</p>
			<p>card content</p>
			<p>card content</p>
		</a-card>
	</a-row>
	<a-row>
		<a-card 
			style="
				width: 800px; 
				height: auto; 
				background: #F5F5F5;"
		>
			<p>card content</p>
			<p>card content</p>
			<p>card content</p>
		</a-card>
	</a-row>
</template>

<script lang="ts">

	import Nav from '../page/Nav.vue'
  import { defineComponent, ref } from 'vue';
	import type { MenuProps } from 'ant-design-vue';

  import { 
		UserOutlined,
		DownOutlined
	} from '@ant-design/icons-vue';
	
  export default defineComponent({
		name: 'StoreContent',
    setup() {
			const handleMenuClick: MenuProps['onClick'] = e => {
				console.log('click', e);
			};
      return {
				handleMenuClick
      };
    },
		components: {
      UserOutlined,
			DownOutlined,
			Nav
    },
  })
  </script>

	