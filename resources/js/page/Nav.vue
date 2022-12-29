<template>
  <a-menu 
    v-model:selectedKeys="current" 
    mode="horizontal"
  >
    <a-menu-item key="mail">
      <template #icon>
        <mail-outlined />
      </template>
      What's New
    </a-menu-item>
    <a-menu-item key="app" disabled>
      <template #icon>
        <appstore-outlined />
      </template>
      <span class="danger-text">import issue</span>
    </a-menu-item>
    <a-sub-menu>
      <template #icon>
        <setting-outlined />
      </template>
      <template #title>Setting</template>
        <a-menu-item 
          key="setting:1"
        >Your Account</a-menu-item>
        <a-menu-item 
          key="setting:2" 
        >
          <a 
            href="/store?select=Teammates" 
            target="_blank" 
            rel="noopener noreferrer"
          >
            Teammates
          </a>
        </a-menu-item>
        <a-menu-item 
          key="setting:3"
        >
          Company
        </a-menu-item>
        <a-menu-item 
          key="setting:4"
        >
          <a 
            href="/store?select=Store" 
            target="_blank" 
            rel="noopener noreferrer"
          >
            Store Integrations
          </a>
        </a-menu-item>
        <a-menu-item 
          key="setting:5"
        >
          Carriers
        </a-menu-item>
        <a-menu-item 
          key="setting:6"
        >
          Shipping
        </a-menu-item>
        <a-menu-item 
          key="setting:7"
        >
          Customs
        </a-menu-item>
        <a-menu-item 
          key="setting:8"
        >
          Plans & Billing
        </a-menu-item>
        <a-menu-item 
          key="setting:9"
        >
          Privacy
        </a-menu-item>
        <a-menu-item 
          key="setting:10"
        >
          Zenstores Labs
        </a-menu-item>
        <a-menu-item 
          key="setting:4"
        >
          <a 
            href="/store?select=addchannel" 
            rel="noopener noreferrer"
          >
            Add Channel
          </a>
        </a-menu-item>
    </a-sub-menu>
    <a-menu-item key="alipay">
      <a 
        href="/test" 
        target="_blank" 
        rel="noopener noreferrer"
      >
        Navigation Four - Link
      </a>
    </a-menu-item>
  </a-menu>
</template>
<script lang="ts">
  import { 
    defineComponent, 
    ref 
  } from 'vue';

  import { 
    MailOutlined, 
    AppstoreOutlined, 
    SettingOutlined 
  } from '@ant-design/icons-vue';

  export default defineComponent({
    name:'Nav',
    setup() {
      const current = ref<string[]>(['mail']);
      return {
        current,
      };
    },
    created() {
      console.log('hvuihgih')
    },
    methods: {
      go(value) {
        alert(value)
      }
    },
    components: {
      MailOutlined,
      AppstoreOutlined,
      SettingOutlined,
    },
  });
</script>

<style>
  .danger-text {
    color:red;
  }
</style>

