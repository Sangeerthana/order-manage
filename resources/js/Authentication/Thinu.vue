<template>
	<a-row type="flex" justify="center"> 
		<a-card title="Register User" style="width: 600px">
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
				<a-row type="flex" justify="center">
					<p>{{formState.firstname}}</p>
				</a-row>
				
				<div class="form-content">
					<a-card style="background-color: #F5F5F5;">
						<h2>Personal Information</h2>
						<a-form-item ref="name" name="firstname">
							<a-input
								placeholder="First Name"
								v-model:value="formState.firstname"
								class="first-name"
							/>
						</a-form-item>
						<a-form-item ref="lastname" name="lastname">
							<a-input
								placeholder="First Name"
								v-model:value="formState.lastname"
							/>
						</a-form-item>

						<a-form-item ref="email" name="email">
							<a-input
								placeholder="Email"
								v-model:value="formState.email"
							/>
						</a-form-item>

						<a-form-item ref="contact_number" name="contact_number">
							<a-input
								placeholder="Contact Number"
								v-model:value="formState.contact_number"
							/>
						</a-form-item>
					</a-card>

					<a-card style="background-color: #F5F5F5;">
						<h2>Access Level</h2>
						<a-form-item  name="role">
							<a-label><b>Role</b></a-label>
							<a-select  placeholder="please select Role" v-model:value="formState.role">
								<a-select-option value="1">Admin</a-select-option>
								<a-select-option value="2">Staff</a-select-option>
								<a-select-option value="3">Trainee</a-select-option>
							</a-select>
						</a-form-item>

						<a-form-item  name="branch">
							<a-label><b>Branch</b></a-label>
							<a-select  placeholder="please select Branch" v-model:value="formState.branch">
								<a-select-option value="Jaffna" select>Jaffna</a-select-option>
								<a-select-option value="Nelliady">Nelliady</a-select-option>
							</a-select>
						</a-form-item>
					</a-card>
					<a-card style="background-color: #F5F5F5;">
						<h2>Credentials</h2>
						<a-form-item ref="contact_number" name="username">
							<a-input
								placeholder="User Name"
								v-model:value="formState.username"
							/>
						</a-form-item>

						<a-form-item ref="contact_number" name="password">
							<a-input
								placeholder="Password"
								v-model:value="formState.password"
							/>
						</a-form-item>
					</a-card>
					<a-row>
						<a-col>
							<a-button type="primary" @click="onSubmit">Create</a-button>
							<a-button style="margin-left: 10px" @click="resetForm">Reset</a-button>
						</a-col>
					</a-row>
				</div>
			</a-form>
  	</a-card>
	</a-row>
</template>

<script lang="ts">
	import { ValidateErrorEntity } from 'ant-design-vue/es/form/interface';
	import { defineComponent, reactive, ref, toRaw, UnwrapRef } from 'vue';
	interface FormState {
    firstname: string
		lastname: string
		email: string
		contact_number: string
		role: string
		branch
		username
		password
  }
	export default defineComponent({
    setup() {
      const formRef = ref();
      const formState: UnwrapRef<FormState> = reactive({
        firstname: '',
				lastname: '',
				email: '',
				contact_number: '',
				role: '',
				branch: '',
				username:'',
				password:''
      });
      const rules = {
        firstname: [
          { 
						required: true, 
						message: 'First Name is required...!', 
						trigger: 'blur' 
					},
        ],
				lastname: [
					{
						required: true, 
						message: 'Last Name is required...!', 
						trigger: 'blur' 
					}
				],
				email: [
					{
						required: true, 
						message: 'Email is required...!', 
						trigger: 'blur' 
					}
				],
				contact_number: [
					{
						required: true, 
						message: 'Contact Number is required...!', 
						trigger: 'blur' 
					}
				],
				role: [
					{
						required: true, 
						message: 'Role is required...!', 
						trigger: 'blur' 
					}
				],
				branch: [
					{
						required: true, 
						message: 'Role is required...!', 
						trigger: 'blur' 
					}
				],
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