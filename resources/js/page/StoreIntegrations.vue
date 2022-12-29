<template>
    <a-layout>
			<Nav></Nav>
      <a-layout>
        <a-layout-sider 
					width="200" 
					style="background: #fff"
				>
					<a-menu 
						v-model:selectedKeys="selectedKeys" 
						theme="dark" 
						mode="inline"
					>
						<a-menu-item key="1">
							<user-outlined />
							<span>Your Account</span>
						</a-menu-item>
						<a-menu-item key="2">
							<usergroup-add-outlined />
							<span>Teammates</span>
						</a-menu-item>
						<a-menu-item key="3">
							<home-outlined />
							<span>Company</span>
						</a-menu-item>
						<a-menu-item key="4">
							<cloud-download-outlined />
							<span>Store Integrations</span>
						</a-menu-item>
						<a-menu-item key="5">
							<car-filled />
							<span>Carriers</span>
						</a-menu-item>
						<a-menu-item key="6">
							<code-sandbox-square-filled /> 
							<span>Shipping</span>
						</a-menu-item>
						<a-menu-item key="7">
							<code-sandbox-square-filled /> 
							<span>Shipping</span>
						</a-menu-item>
						<a-menu-item key="8">
							<code-sandbox-square-filled /> 
							<span>Shipping</span>
						</a-menu-item>
						<a-menu-item key="9">
							<code-sandbox-square-filled /> 
							<span>Shipping</span>
						</a-menu-item>
						<a-menu-item key="10">
							<code-sandbox-square-filled /> 
							<span>Shipping</span>
						</a-menu-item>
					</a-menu>
        </a-layout-sider>
        <a-layout 
					style="padding: 0 24px 24px"
				>
          <a-breadcrumb style="margin: 16px 0">
            <a-breadcrumb-item>Home</a-breadcrumb-item>
            <a-breadcrumb-item>List</a-breadcrumb-item>
            <a-breadcrumb-item>{{selectedItem}}</a-breadcrumb-item>
          </a-breadcrumb>
					<a-card 
						style="margin:0"
						v-if="selectedItem == 'Store'"
					>
						<StoreContent></StoreContent>
					</a-card>
					<a-card 
						style="margin:0"
						v-if="selectedItem == 'Teammates'"
					>
						<Teammets></Teammets>
					</a-card>
					<a-card 
						style="margin:0"
						v-if="selectedItem == 'addchannel'"
					>
						<AddChannel></AddChannel>
					</a-card>
					
        </a-layout>
      </a-layout>
    </a-layout>
  </template>
  <script lang="ts">

		import { 
			UserOutlined, 
			LaptopOutlined, 
			NotificationOutlined,
			UsergroupAddOutlined,
			HomeOutlined,
			CloudDownloadOutlined,
			CarFilled,
			CodeSandboxSquareFilled,
			DownOutlined
		} from '@ant-design/icons-vue'

		import Nav from '../page/Nav.vue'
		import { defineComponent, ref } from 'vue'
		import type { MenuProps } from 'ant-design-vue'
		import Teammets from '../page/Teammates.vue'
		import StoreContent from '../page/StoreContent.vue'
		import AddChannel from '../page/AddChannel.vue'
		
		export default defineComponent({
			setup() {
				const handleMenuClick: MenuProps['onClick'] = e => {
					console.log('click', e);
				};

				return {
					selectedKeys1: ref<string[]>(['2']),
					selectedKeys: ref<string[]>(['1']),
					collapsed: ref<boolean>(false),
					openKeys: ref<string[]>(['sub1']),
					handleMenuClick
				};
			},
			data() {
				return {
					selectedItem: ''
				}
			},
			created() {
				const urlParams = 
				new URLSearchParams(window.location.search).get('select')
				this.selectedItem = urlParams
			},
			components: {
				UserOutlined,
				LaptopOutlined,
				NotificationOutlined,
				UsergroupAddOutlined,
				HomeOutlined,
				CloudDownloadOutlined,
				CarFilled,
				CodeSandboxSquareFilled,
				DownOutlined,
				StoreContent,
				Nav,
				Teammets,
				AddChannel
			},
		})
  </script>
  <style>
		#components-layout-demo-top-side-2 .logo {
			float: left;
			width: 120px;
			height: 31px;
			margin: 16px 24px 16px 0;
			background: rgba(255, 255, 255, 0.3);
		}
		.ant-row-rtl #components-layout-demo-top-side-2 .logo {
			float: right;
			margin: 16px 0 16px 24px;
		}
		.site-layout-background {
			background: #fff;
		}
		.ant-layout .ant-layout-has-sider {
			height:100vh;
		}
		.ant-menu-dark.ant-menu-inline, .ant-menu-dark.ant-menu-vertical, .ant-menu-dark.ant-menu-vertical-left, .ant-menu-dark.ant-menu-vertical-right {
			border-right: 0;
			height: 100vh;
		}
		.ant-menu-dark.ant-menu-inline .ant-menu-item, .ant-menu-dark.ant-menu-vertical .ant-menu-item, .ant-menu-dark.ant-menu-vertical-left .ant-menu-item, .ant-menu-dark.ant-menu-vertical-right .ant-menu-item {
			left: 0;
			margin-left: 0;
			border-right: 0;
			color: black;
			font-size: 1rem;
		}
		.ant-menu-dark.ant-menu-inline, .ant-menu-dark.ant-menu-vertical, .ant-menu-dark.ant-menu-vertical-left, .ant-menu-dark.ant-menu-vertical-right {
				border-right: 0;
				background: #EDF2F7;
		}
  </style>
  