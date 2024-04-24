<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Create</h5>
                <form method="POST" class="py-4" action="/admin/admins/save" enctype="multipart/form-data">
                    <div class="form-outline mb-4 mt-4">
                        <input type="name" name="name" id="form2Example2" class="form-control" placeholder="Name (obligatory)" />
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="surname" name="surname" id="form2Example1" class="form-control" placeholder="Surname (obligatory)" />
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="email" name="email"  id="form2Example1" class="form-control" placeholder="Email (obligatory)" />
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="telephone" name="telephone" id="form2Example1" class="form-control" placeholder="Telephone" />
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="address" name="address"  id="form2Example1" class="form-control" placeholder="Address" />
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="username" name="username"  id="form2Example1" class="form-control" placeholder="Username (obligatory)" />
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <input type="password" name="password"  id="form2Example1" class="form-control" placeholder="Password (obligatory)" />
                    </div>


                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>
                </form>
            </div>
          </div>
        </div>
      </div>