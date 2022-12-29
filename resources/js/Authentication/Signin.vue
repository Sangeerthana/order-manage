<template>
	<div class="full-card">
		<a-card 
			title="Register User" 
			class="card"
		>
		{{user}}
			<a-card title="Inner card title">
				<a-form
					@submit.prevent="userRegister">
					<a-row>
						<a-col :span="12">
							<a-form-item>
								<a-input  
									placeholder="First Name"
									v-model:value="user.firstname"
								></a-input>
							</a-form-item>
						</a-col>
						<a-col :span="12">
							<a-form-item>
								<a-input  
									placeholder="Last Name"
									v-model:value="user.lastname"
								></a-input>
							</a-form-item>
						</a-col>
					</a-row>

					<a-row>
						<a-col :span="12">
							<a-form-item>
								<a-input  
									placeholder="User Name"
									v-model:value="user.user_name"
								></a-input>
							</a-form-item>
						</a-col>
					</a-row>

					<a-row>
						<a-col :span="20">
							<a-form-item>
								<a-input  
									placeholder="Email"
									v-model:value="user.email"
								></a-input>
							</a-form-item>
						</a-col>
					</a-row>

					<a-row>
						<a-col :span="12">
							<a-form-item>
								<a-input  
									placeholder="Contact Number"
									v-model:value="user.contact"
								></a-input>
							</a-form-item>
						</a-col>
						<a-col :span="12">
							<a-form-item>
								<a-select 
									placeholder="please select your role"
									v-model:value="user.role"
								>
									<a-select-option value="1">Admin</a-select-option>
									<a-select-option value="2">Staff</a-select-option>
									<a-select-option value="3">Trainee</a-select-option>
								</a-select>
							</a-form-item>
						</a-col>
					</a-row>

					<a-row>
						<a-col :span="15">
							<a-form-item>
								<a-select 
									placeholder="please select your branch"
									v-model:value:value="user.branch"
								>
									<a-select-option value="Jaffna">Jaffna</a-select-option>
									<a-select-option value="Nelliady">Nelliady</a-select-option>
								</a-select>
							</a-form-item>
						</a-col>
					</a-row>

					<a-row>
						<a-col :span="12">
							<a-form-item>
								<a-input  
									placeholder="Password" 
									type="password" 
									autocomplete="off"
									v-model:value="user.password"
								></a-input>
							</a-form-item>
						</a-col>
						<a-col :span="12">
							<a-form-item>
								<a-input 
									placeholder="Confirm password" 
									type="password" 
									autocomplete="off"
									v-model:value="user.confirm_password"
								></a-input>
							</a-form-item>
						</a-col>
					</a-row>
					<a-row>
						<a-button type="primary" html-type="submit">Primary Button</a-button>
					</a-row>
				</a-form>
			</a-card>
		</a-card>
	</div>
</template>

<script>
	import fetchData from "../Function/Fetch.js"
	export default {
		data() {
			return {
				user:{},
				formSubmitStatus:false,
				errors:{}
			}
		},
		methods: {
			userRegister() {
				console.log('hubusbg')
				this.formSubmitStatus = true
				this.errors = {}
				fetchData({
					url: '/user-register',
					method: 'POST',
					body: this.user,
					success: (res) => {
						setTimeout(
							this.$router.push({
								path: '/signin'
							}),3000)	
					},
					error: (e) => {
						this.formSubmitStatus = false
						console.log(e.message)
						this.errors = e.errors
						notify({
							title: "Authorization",
							text: "Something wrong please Check...!",
						});
					}
				})
			}
		}
	}
</script>

<style>
p {
	font-size: 14px; 
	color: rgba(0, 0, 0, 0.85);
	margin-bottom: 16px; 
	font-weight: 500
}
.full-card {
	display: flex;
  justify-content: center;
	margin-top: 50px;
}
.card {
	background: rgb(218, 214, 214);
	width:600px;
	
}
</style>
  
  
  