<template>
	<a-row type="flex" justify="center"> 
		<a-card title="Register User" style="width: 550px">
			<a-form
				ref="formRef"
				:model="formState"
				:rules="rules"
				:label-col="labelCol"
				:wrapper-col="wrapperCol"
			>
				<a-row type="flex" justify="center"> 
					<img 
						class="avatar-image"
						alt="example" 
						src="https://www.digitweb-jf.com/images/male.svg" 
					/>
				</a-row>
        <a-form-item ref="username" name="username">
          <a-input
            placeholder="User Name"
            v-model:value="formState.username"
            class="first-name"
          />
        </a-form-item>
        <a-form-item ref="password" name="password">
          <a-input
            type="password" 
            placeholder="Password"
            v-model:value="formState.password"
          />
        </a-form-item>
        <a-row>
          <a-col>
            <a-button type="primary" @click="onSubmit">Login</a-button>
            <a-button style="margin-left: 10px" @click="resetForm">Reset</a-button>
          </a-col>
        </a-row>
			</a-form>
  	</a-card>
	</a-row>
</template>

<script lang="ts">
	import { ValidateErrorEntity } from 'ant-design-vue/es/form/interface';
	import { defineComponent, reactive, ref, toRaw, UnwrapRef } from 'vue';
	interface FormState {
		username
		password
  }
	export default defineComponent({
    setup() {
      const formRef = ref();
      const formState: UnwrapRef<FormState> = reactive({
				username:'',
				password:''
      });
      const rules = {
				username: [
					{
						required: true, 
						message: 'Please input Activity User Name', 
						trigger: 'blur' 
					},
					{ 
						min: 3, 
						max: 10, 
						message: 'Length should be 3 to 10', 
						trigger: 'blur' 
					},
				],
				password: [
					{
						required: true, 
						message: 'Password is required...!', 
						trigger: 'blur' 
					},
					{ 
						min: 3, 
						max: 8, 
						message: 'Length should be 3 to 8', 
						trigger: 'blur'
					},
				],

      }
      const onSubmit = () => {
        formRef.value
          .validate()
          .then(() => {
            console.log('values', formState, toRaw(formState));
            alert();
          })
          .catch((error: ValidateErrorEntity<FormState>) => {
            console.log('error', error);
          });
      };
      const resetForm = () => {
        formRef.value.resetFields();
      };
      return {
        formRef,
        labelCol: { span: 4 },
        wrapperCol: { span: 14 },
        other: '',
        formState,
        rules,
        onSubmit,
        resetForm,
      };
    },
  });
</script>

<style>
  .ant-card {
    margin-top: 60px;
  }
  .avatar-image {
    width: 200px;
  }
  .form-content {
    margin: 10px;
  }
  
  .ant-form-item-control-input-content{
    width:100%
  }

  .ant-form-item {
      box-sizing: border-box;
      color: rgba(0, 0, 0, 0.85);
      font-size: 14px;
      font-variant: tabular-nums;
      line-height: 1.5715;
      list-style: none;
      font-feature-settings: 'tnum';
      margin-bottom: 10px;
      vertical-align: top;
      width: 800px;
  }
</style>