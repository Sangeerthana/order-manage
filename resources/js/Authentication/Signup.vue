<template>
	<div>
		<div class="container mt-5" style="width:700px;">
			<div class="card">
				<div class="card-body p-5">
					<form 
						@submit.prevent="userRegister"
						action=""
					>
						<div class="row mb-3 mt-3">
							<div class="col">
								<label><b>First Name</b></label>
								<input 
									type="text" 
									class="form-control" 
									v-model="user.firstname"
								/>
								<div
									class="text-danger small mb-2"
									v-if="errors.firstname"
								>
									<span
										v-for="(data, index) in errors.firstname"
										:key="index"
									>
										{{data}}
									</span>
								</div>
							</div>
							<div class="col">
								<label><b>Last Name</b></label>
								<input 
									type="text" 
									class="form-control" 
									v-model="user.lastname"
								/>
								<div
									class="text-danger small mb-2"
									v-if="errors.lastname"
								>
									<span
										v-for="(data, index) in errors.lastname"
										:key="index"
									>
										{{data}}
									</span>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-8">
								<label><b>Email</b></label>
								<input 
									type="email" 
									class="form-control" 
									v-model="user.email"
								/>
								<div
									class="text-danger small mb-2"
									v-if="errors.email"
								>
									<span
										v-for="(data, index) in errors.email"
										:key="index"
									>
										{{data}}
									</span>
								</div>
							</div>
							<div class="col-4">
								<label><b>Contact Number</b></label>
								<input type="number" class="form-control" v-model="user.contact">
								<div
									class="text-danger small mb-2"
									v-if="errors.contact"
								>
									<span
										v-for="(data, index) in errors.contact"
										:key="index"
									>
										{{data}}
									</span>
								</div>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-6">
								<label for=""><b>Branch</b></label>
								<select class="form-select" v-model="user.branch">
									<option>Choose...</option>
									<option value="Jaffna">Jaffna</option>
									<option value="Nelliady">Nelliady</option>
								</select>
								<div
									class="text-danger small mb-2"
									v-if="errors.branch"
								>
									<span
										v-for="(data, index) in errors.branch"
										:key="index"
									>
										{{data}}
									</span>
								</div>
							</div>
							<div class="col-6">
								<label for=""><b>Role</b></label>
								<select class="form-select" v-model="user.role">
									<option>Choose...</option>
									<option value="1">Admin</option>
									<option value="2">Staff</option>
									<option value="3">Trainee</option>
								</select>
								<div
									class="text-danger small mb-2"
									v-if="errors.role"
								>
									<span
										v-for="(data, index) in errors.role"
										:key="index"
									>
										{{data}}
									</span>
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-8">
								<label><b>User Name</b></label>
								<input type="text" class="form-control" v-model="user.user_name">
								<div
									class="text-danger small mb-2"
									v-if="errors.user_name"
								>
									<span
										v-for="(data, index) in errors.user_name"
										:key="index"
									>
										{{data}}
									</span>
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<label><b>Password</b></label>
								<input type="password" class="form-control" v-model="user.password">
								<div
									class="text-danger small mb-2"
									v-if="errors.password"
								>
									<span
										v-for="(data, index) in errors.password"
										:key="index"
									>
										{{data}}
									</span>
								</div>
							</div>
							<div class="col">
								<label><b>Confirm Password</b></label>
								<input type="password" class="form-control" v-model="user.confirm_password">
								<div
									class="text-danger small mb-2"
									v-if="errors.confirm_password"
								>
									<span
										v-for="(data, index) in errors.confirm_password"
										:key="index"
									>
										{{data}}
									</span>
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col">
								<button 
									type="submit" 
									class="btn btn-success"
									:disabled="formSubmitStatus"
								>{{ formSubmitStatus ? 'Validating...':'Register User'}}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div>
			<notifications position="top left" class="m-3" />
		</div>
	</div>
</template>

<script>
	import fetchData from "../Function/Fetch.js"
	import { notify } from "@kyvg/vue3-notification";
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